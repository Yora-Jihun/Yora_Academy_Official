<main class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Profile Settings</h1>
            <p class="text-sm text-gray-500 mt-0.5">Manage your account information and preferences</p>
        </div>
    </div>

    <div class="bg-white border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Personal Information</h3>

        <form wire:submit="submit" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block text-xs font-medium text-gray-500 mb-1.5">First Name</label>
                    <input id="first_name" type="text" wire:model="first_name" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100 rounded-lg focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    @error('first_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="middle_name" class="block text-xs font-medium text-gray-500 mb-1.5">Middle Name</label>
                    <input id="middle_name" type="text" wire:model="middle_name" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100 rounded-lg focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    @error('middle_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="last_name" class="block text-xs font-medium text-gray-500 mb-1.5">Last Name</label>
                    <input id="last_name" type="text" wire:model="last_name" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100 rounded-lg focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    @error('last_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="suffix" class="block text-xs font-medium text-gray-500 mb-1.5">Suffix</label>
                    <input id="suffix" type="text" wire:model="suffix" placeholder="e.g. Jr., Sr., III" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100 rounded-lg focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    @error('suffix')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-medium text-gray-500 mb-1.5">Email</label>
                    <input id="email" type="email" wire:model="email" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100 rounded-lg focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="country_code" class="block text-xs font-medium text-gray-500 mb-1.5">Country Code</label>
                    <input id="country_code" type="text" wire:model="country_code" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100 rounded-lg focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    @error('country_code')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="contact_to" class="block text-xs font-medium text-gray-500 mb-1.5">Contact Number</label>
                    <input id="contact_to" type="text" wire:model="contact_to" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100 rounded-lg focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    @error('contact_to')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">Save Changes</button>
            </div>
        </form>
    </div>

    @script
    <script>
        Livewire.on('notify', (message) => alert(message));
    </script>
    <script>
        const mainContent = document.getElementById('mainContent');

        Livewire.on('toggleSidebar', () => {
            const body = document.body;
            body.classList.toggle('sidebar-open');
            body.classList.toggle('sidebar-closed');

            if (body.classList.contains('sidebar-open')) {
                mainContent.style.marginLeft = '250px';
            } else {
                mainContent.style.marginLeft = '0px';
            }
        });
    </script>
    @endscript
</main>
