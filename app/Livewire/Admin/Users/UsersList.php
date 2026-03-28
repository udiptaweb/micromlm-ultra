<?php

namespace App\Livewire\Admin\Users;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\Url;

class UsersList extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $sortBy = 'created_at';

    #[Url]
    public string $sortDir = 'desc';

    #[Url]
    public string $filter = 'all';

    public int $perPage = 10;

    #[On('deleteUser')]
    public function deleteUser($userId): void
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully.');
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function setSorting(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDir = 'asc';
        }
    }
    public function render()
    {
        return view('livewire.admin.users.users-list', [
            'users' => User::query()
                ->when(
                    $this->search,
                    fn($query) =>
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                )
                ->when(
                    $this->filter && $this->filter !== 'all',
                    fn($query) => $query->where('role', $this->filter)
                )
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ])->layout('layouts.app');
    }
}
