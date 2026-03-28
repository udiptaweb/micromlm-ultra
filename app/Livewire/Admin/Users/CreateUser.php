<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;

class CreateUser extends Component
{
    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'user';
    public string $referral_code = '';

    public function createUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
            'username' => 'required|string|max:255|unique:users',
            'referral_code' => 'nullable|string|max:255|unique:users',
        ]);

        $referredUser = \App\Models\User::where('referral_code', $this->referral_code)->first();

        \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
            'username' => $this->username,
            'referral_code' => $this->referral_code,
            'sponsor_id' => $referredUser ? $referredUser->id : null,
        ]);

        session()->flash('message', 'User created successfully.');

        $this->reset(['name', 'email', 'password', 'role', 'username', 'referral_code']);
    }

    public function render()
    {
        return view('livewire.admin.users.create-user')->layout('layouts.app');
    }
}
