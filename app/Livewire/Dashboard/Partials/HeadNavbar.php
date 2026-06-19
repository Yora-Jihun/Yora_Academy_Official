<?php

namespace App\Livewire\Dashboard\Partials;

use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class HeadNavbar extends Component
{
    public function avatarUrl(): string
    {
        if (auth()->user()?->avatar) {
            return Storage::disk('public')->url('avatars/'.auth()->user()->avatar);
        }

        return asset('assets/images/Jerome_Edica.jpg');
    }

    #[On('profile-updated')]
    public function refreshAvatar(): void {}

    public function render(): View
    {
        return view('livewire.dashboard.partials.headnavbar');
    }
}
