<div class="w-full" @if($cooldown > 0) wire:poll.1s="tick" @endif>
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
                                Verify Your Email
                            </h1>
                            <p class="text-sm leading-6 text-slate-500">
                                Enter the 6-digit code sent to {{ $email }}
                            </p>
                        </div>
                    </div>

                    <form wire:submit="verify" class="space-y-4">
                        @if($otpError)
                            @include('partials.alerts', [
                                'type' => 'error',
                                'message' => $otpError,
                                'class' => 'mb-4',
                            ])
                        @endif

                        <div>
                            @include('livewire.auth.partials.input-field', [
                                'name' => 'otp',
                                'label' => 'Verification Code',
                                'type' => 'text',
                                'placeholder' => '123456',
                                'autocomplete' => 'one-time-code',
                                'attributes' => new \Illuminate\View\ComponentAttributeBag([
                                    'wire:model' => 'otp',
                                    'required' => true,
                                    'maxlength' => '6',
                                    'autofocus' => true,
                                    'inputmode' => 'numeric',
                                    'pattern' => '[0-9]*',
                                ]),
                            ])
                        </div>

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="verify"
                            class="inline-flex w-full items-center justify-center gap-2 bg-[#5B5FEF] px-4 py-3.5 text-sm font-semibold text-white transition duration-200 hover:bg-[#4A4DDF] focus:outline-none focus:ring-4 focus:ring-[#5B5FEF]/20 disabled:opacity-70 disabled:cursor-not-allowed"
                        >
                            <svg wire:loading wire:target="verify" class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="verify">Verify &amp; Create Account</span>
                            <span wire:loading wire:target="verify">Verifying…</span>
                        </button>

                        <div class="flex justify-between text-sm">
                            <button type="button" wire:click="goBack" wire:loading.attr="disabled" wire:target="goBack" class="text-gray-600 hover:underline disabled:opacity-60">
                                Change Email
                            </button>
                            @if($cooldown > 0)
                                <span class="text-gray-400 cursor-not-allowed">
                                    Resend Code in {{ $cooldown }}s
                                </span>
                            @else
                                <button type="button" wire:click="resend" wire:loading.attr="disabled" wire:target="resend" class="text-[#5B5FEF] hover:underline disabled:opacity-60">
                                    Resend Code
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>