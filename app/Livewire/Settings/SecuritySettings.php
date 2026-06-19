<?php

namespace App\Livewire\Settings;

use App\Services\AuthService;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Livewire\Component;

class SecuritySettings extends Component
{
    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $delete_password = '';

    private AuthService $authService;

    public function boot(AuthService $authService): void
    {
        $this->authService = $authService;
    }

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

    public function deleteAccount(): void
    {
        $this->validate([
            'delete_password' => ['required', 'string'],
        ]);

        if (! password_verify($this->delete_password, auth()->user()->password)) {
            $this->addError('delete_password', 'The provided password does not match your current password.');

            return;
        }

        $user = auth()->user();

        $this->authService->logout();

        $user->delete();

        $this->redirect(route('welcome'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.settings.security-settings')
            ->layout('layouts.dashboard');
    }
}
