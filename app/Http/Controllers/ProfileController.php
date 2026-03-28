<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);
        $user->profile()->updateOrCreate(['user_id' => $user->id], $data);
        return redirect()->route('profile')->with('success', 'Profile updated!');
    }
}
