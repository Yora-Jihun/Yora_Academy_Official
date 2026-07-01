<?php

namespace App\Livewire\Docs;

use App\Models\Doc;
use Illuminate\View\View;
use Livewire\Component;

class ExploreDocs extends Component
{
    public function render(): View
    {
        $docs = Doc::where('is_public', true)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.docs.explore', [
            'docs' => $docs,
        ])->layout('layouts.explore', ['active' => 'explore']);
    }
}
