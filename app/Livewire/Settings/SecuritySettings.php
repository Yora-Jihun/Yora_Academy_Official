<?php

namespace App\Livewire\Settings;

use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class SecuritySettings extends Component
{
    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function submit(): void
    {
        $this->validate([
            'current_password' => ['required', 'string'],
                'password' => ['required', 'string', Password::defaults()->min(8), 'confirmed'],
        ]);

        if (! password_verify($this->current_password, auth()->user()->password)) {
            $this->addError('current_password', 'The provided password does not match your current password.');

            return;
        }

        auth()->user()->update([
            'password' => $this->password,
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);

        session()->flash('status', 'Password updated successfully');
    }

    public function render(): View
    {
        return view('livewire.settings.security-settings')
            ->layout('layouts.dashboard');
    }
}
