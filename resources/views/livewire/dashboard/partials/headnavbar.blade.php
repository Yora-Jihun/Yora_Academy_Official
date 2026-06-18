    <div class="sticky top-0 z-30 h-[72px] bg-white flex items-center justify-end px-6 mb-6">
        <div class="flex items-center gap-3">
            <button type="button" class="relative p-2 rounded-lg hover:bg-gray-50 transition group">
                <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9z" />
                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                </svg>
                <span class="absolute -top-0.5 -right-0.5 min-w-[15px] h-[15px] flex items-center justify-center bg-[#EF4444] text-white text-[9px] font-bold rounded-full px-1 leading-none shadow-sm">3</span>
            </button>

            <div class="w-px h-6 bg-gray-200"></div>

            <div class="relative group">
                <div class="w-[36px] h-[36px] rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center shadow-sm cursor-pointer overflow-hidden ring-2 ring-white">
                    <img src="{{ asset('assets/images/Jerome_Edica.jpg') }}" class="w-[36px] h-[36px] rounded-full object-cover" alt="Jerome Edica">
                </div>

                <div class="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl border border-gray-100 shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                    <div class="p-4 border-b border-gray-50">
                        <span class="block text-sm font-semibold text-gray-900">{{ auth()->user()->fullname ?? 'User' }}</span>
                        <span class="block text-xs text-gray-400 mt-0.5">Employee</span>
                    </div>
                    <div class="p-2 space-y-0.5">
                        <a href="{{ route('profile-settings') }}" wire:navigate class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px] text-gray-700 hover:bg-gray-50 transition">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            Profile Settings
                        </a>
                        <a href="{{ route('security-settings') }}" wire:navigate class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px] text-gray-700 hover:bg-gray-50 transition">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            Security
                        </a>
                        <div class="border-t border-gray-50 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px] text-red-600 hover:bg-red-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                    <polyline points="16 17 21 12 16 7" />
                                    <line x1="21" x2="9" y1="12" y2="12" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
