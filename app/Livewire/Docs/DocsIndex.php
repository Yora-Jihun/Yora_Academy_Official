    <?php

    namespace App\Livewire\Docs;

    use Illuminate\View\View;
    use Livewire\Component;

    class DocsIndex extends Component
    {
        public array $docs = [];

        public function mount(): void
        {
            $this->docs = auth()->user()->docs()->orderBy('created_at', 'desc')->get()->toArray();
        }

        public function render(): View
        {
            return view('livewire.docs.index')
                ->layout('layouts.docs', ['active' => 'docs']);
        }
    }
