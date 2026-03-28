<?php

namespace App\Livewire\Admin;

use App\Models\EPin;
use App\Models\EPinRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ManageEPinRequests extends Component
{
    use WithPagination;

    public $admin_remark;

    /**
     * Approve the E-PIN request and generate codes
     */
    public function approveRequest($requestId)
    {
        $request = EPinRequest::where('status', 'pending')->findOrFail($requestId);

        try {
            DB::transaction(function () use ($request) {
                // 1. Generate the requested number of PINs
                for ($i = 0; $i < $request->pin_count; $i++) {
                    EPin::create([
                        'code' => EPin::generateCode(), // Uses the helper in EPin model
                        'amount' => $request->pin_amount,
                        'created_by' => Auth::id(),
                        'assigned_to' => $request->user_id, // Member who requested them
                        'status' => 'active',
                    ]);
                }

                // 2. Update the request status
                $request->update([
                    'status' => 'approved',
                    'admin_remark' => $this->admin_remark ?? 'Approved by Admin',
                ]);
            });

            session()->flash('success', "Request approved. {$request->pin_count} E-PINs have been issued to {$request->user->name}.");
            $this->reset('admin_remark');

        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Reject the request
     */
    public function rejectRequest($requestId)
    {
        $request = EPinRequest::findOrFail($requestId);
        
        $request->update([
            'status' => 'rejected',
            'admin_remark' => $this->admin_remark ?? 'Payment verification failed.',
        ]);

        session()->flash('info', 'Request has been rejected.');
        $this->reset('admin_remark');
    }

    public function render()
    {
        return view('livewire.admin.manage-e-pin-requests', [
            'requests' => EPinRequest::with('user')
                ->where('status', 'pending')
                ->latest()
                ->paginate(10)
        ])->layout('layouts.app');
    }
}
