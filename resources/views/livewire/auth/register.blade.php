<div class="w-full">
    <div class="overflow-hidden bg-white shadow-2xl shadow-slate-200/70 ring-1 ring-slate-900/5 transition-all duration-300 ease-out">
        <div class="grid min-h-screen grid-cols-1 lg:grid-cols-2 lg:min-h-0">
            @include('livewire.auth.partials.side-landing')

            <section class="flex items-center justify-center bg-white p-8 sm:p-12 lg:p-16">
                <div class="w-full max-w-md space-y-6">
                    <div class="space-y-6">
                        <a href="{{ route('welcome') }}" wire:navigate class="inline-flex items-center gap-3 transition-all duration-200 ease-out hover:opacity-90">
                            <div class="w-10 h-10 bg-[#5B5FEF] rounded-none flex items-center justify-center shadow-sm">
                                <x-icon name="book-open" class="w-5 h-5 text-white" />
                            </div>
                            <span class="text-lg font-semibold tracking-tight text-gray-900">Yora Academy</span>
                        </a>

                        <div class="space-y-2">
                            <h1 class="text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">
                                Create an Account
                            </h1>
                            <p class="text-sm leading-6 text-slate-500">
                                Start with a secure workspace designed for modern teams.
                            </p>
                        </div>
                    </div>

                    <form wire:submit="submit" class="space-y-4">
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            @include('livewire.auth.partials.input-field', [
                                'name' => 'first_name',
                                'label' => 'First Name',
                                'placeholder' => 'Jane',
                                'autocomplete' => 'given-name',
                                'attributes' => new \Illuminate\View\ComponentAttributeBag([
                                    'wire:model' => 'first_name',
                                    'required' => true,
                                    'autofocus' => true,
                                ]),
                            ])

                            @include('livewire.auth.partials.input-field', [
                                'name' => 'last_name',
                                'label' => 'Last Name',
                                'placeholder' => 'Doe',
                                'autocomplete' => 'family-name',
                                'attributes' => new \Illuminate\View\ComponentAttributeBag([
                                    'wire:model' => 'last_name',
                                    'required' => true,
                                ]),
                            ])
                        </div>

                        <div>
                            @include('livewire.auth.partials.input-field', [
                                'name' => 'email',
                                'label' => 'Email',
                                'type' => 'email',
                                'placeholder' => 'you@example.com',
                                'autocomplete' => 'email',
                                'attributes' => new \Illuminate\View\ComponentAttributeBag([
                                    'wire:model' => 'email',
                                    'required' => true,
                                ]),
                            ])
                        </div>

                        <x-password-input
                            name="password"
                            label="Password"
                            type="password"
                            placeholder="At least 8 characters"
                            autocomplete="new-password"
                            model="password"
                            required
                        />

                        <x-password-input
                            name="password_confirmation"
                            label="Confirm Password"
                            type="password"
                            placeholder="Re-enter password"
                            autocomplete="new-password"
                            model="password_confirmation"
                            required
                        />

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="submit"
                            class="inline-flex w-full items-center justify-center gap-2 bg-[#5B5FEF] px-4 py-3.5 text-sm font-semibold text-white transition duration-200 hover:bg-[#4A4DDF] focus:outline-none focus:ring-4 focus:ring-[#5B5FEF]/20 disabled:opacity-70 disabled:cursor-not-allowed"
                            >
                            <svg wire:loading wire:target="submit" class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="submit">Create account</span>
                            <span wire:loading wire:target="submit">Creating account…</span>
                        </button>

                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="bg-white px-2 text-slate-500">or</span>
                            </div>
                        </div>

                        <button
                            type="button"
                            class="inline-flex w-full items-center justify-center gap-3 border border-slate-200 bg-white px-4 py-3.5 text-sm font-semibold text-slate-700 transition duration-200 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-200"
                            >
                            <svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill="#4285F4" d="M23.77 12.27c0-.83-.07-1.64-.2-2.42H12v4.57h6.64a5.68 5.68 0 0 1-2.47 3.72v3.04h3.99c2.33-2.14 3.61-5.3 3.61-8.91Z" />
                                <path fill="#34A853" d="M12 24c3.32 0 6.11-1.1 8.16-2.99l-3.99-3.04c-1.11.75-2.53 1.19-4.17 1.19-3.2 0-5.91-2.16-6.88-5.07H1.03v3.15A12 12 0 0 0 12 24Z" />
                                <path fill="#FBBC05" d="M5.12 14.09A7.44 7.44 0 0 1 4.75 12c0-.72.13-1.42.37-2.09V6.76H1.03A12 12 0 0 0 0 6.76l4.09 3.15C6.09 7 8.8 4.84 12 4.84Z" />
                                <path fill="#EA4335" d="M12 4.84c1.81 0 3.43.62 4.71 1.84l3.54-3.54C18.11 1.17 15.32 0 12 0A12 12 0 0 0 1.03 6.76l4.09 3.15C6.09 7 8.8 4.84 12 4.84Z" />
                            </svg>
                            Sign up with Google
                        </button>
                    </form>

                    <p class="text-center text-sm text-gray-500">
                        Already have an account?
                        <a href="{{ route('login') }}" wire:navigate class="font-semibold text-[#5B5FEF] transition-all duration-200 ease-out hover:text-[#4A4DDF]">
                            Sign in
                        </a>
                    </p>
                </div>
            </section>
        </div>
    </div>
</div>
