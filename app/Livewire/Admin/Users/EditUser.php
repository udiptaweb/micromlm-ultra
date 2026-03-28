<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;

class EditUser extends Component
{
    public int $userId;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = '';

    public function mount($userId)
    {
        $this->userId = $userId;
        $user = \App\Models\User::findOrFail($userId);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->userId,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        $user = \App\Models\User::findOrFail($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = $this->role;

        if ($this->password) {
            $user->password = bcrypt($this->password);
        }

        $user->save();

        session()->flash('message', 'User updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.users.edit-user')->layout('layouts.app');
    }
}
