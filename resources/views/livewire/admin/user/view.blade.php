<div>
    <div class="relative">
        <!-- Modal header -->
        <div>
            <div class="flex justify-between items-center py-4 px-6 dark:border-gray-700">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-300">User Information</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Personal details and other information.</p>
                </div>
            </div>
        </div>
        <!-- Modal body -->
        <div class="max-h-[65vh] overflow-y-auto">
            <div class="border-t border-gray-200 dark:border-gray-700">
                <dl>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">First Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $user->first_name }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $user->last_name }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $user->email }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $user->status->names() }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">
                            {{ $user->created_at->format('F j, Y g:i a') }}
                        </dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated At</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $user->updated_at->format('F j, Y g:i a') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        <!-- Modal Footer -->
        <div
            class="px-4 py-3 sm:px-6 flex flex-col sm:flex-row items-center justify-between border-t border-gray-200 dark:border-gray-700 space-y-2">
            <x-button.secondary-button wire:click="$emit('closeModal')" type="button" class="w-full sm:w-auto">Close</x-button.secondary-button>
            <x-button.primary-button href="{{ route('admin.users', ['users' => $user->id]) }}" class="w-full sm:w-auto">Edit</x-button.primary-button>
        </div>
    </div>
</div>
