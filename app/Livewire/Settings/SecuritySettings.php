<?php

namespace App\Livewire\Settings;

use App\Services\AuthService;
use App\Services\OtpService;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Livewire\Component;

class SecuritySettings extends Component
{
    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $delete_email = '';

    public string $delete_otp = '';

    public int $delete_cooldown = 0;

    public string $deleteError = '';

    public bool $showDeleteModal = false;

    private AuthService $authService;

    private OtpService $otpService;

    public function boot(AuthService $authService, OtpService $otpService): void
    {
        $this->authService = $authService;
        $this->otpService = $otpService;
    }

    public function mount(): void
    {
        $this->delete_email = auth()->user()->email ?? '';
    }

    public function openDeleteModal(): void
    {
        $this->showDeleteModal = true;
        $this->deleteError = '';
        $this->delete_otp = '';
        $this->delete_cooldown = $this->otpService->getResendCooldownRemaining($this->delete_email, 'account_deletion');
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->deleteError = '';
        $this->delete_otp = '';
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

    public function sendDeleteOtp(): void
    {
        $this->validate([
            'delete_email' => ['required', 'string', 'email'],
        ]);

        $this->deleteError = '';

        try {
            $this->otpService->send($this->delete_email, 'account_deletion');
            $this->delete_cooldown = $this->otpService->getResendCooldownRemaining($this->delete_email, 'account_deletion');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->deleteError = $e->getMessage();
        }
    }

    public function verifyDeleteOtp(): void
    {
        $this->validate([
            'delete_otp' => ['required', 'digits:6'],
        ]);

        $this->deleteError = '';

        if (! $this->otpService->verify($this->delete_email, $this->delete_otp, 'account_deletion', request()->ip())) {
            $this->deleteError = 'Invalid or expired verification code.';
            $this->delete_otp = '';

            return;
        }

        $user = auth()->user();

        $this->authService->logout();

        $user->delete();

        $this->redirect(route('welcome'), navigate: true);
    }

    public function tick(): void
    {
        if ($this->showDeleteModal) {
            $this->delete_cooldown = $this->otpService->getResendCooldownRemaining($this->delete_email, 'account_deletion');
        }
    }

    public function render(): View
    {
        return view('livewire.settings.security-settings')
            ->layout('layouts.dashboard');
    }
}
