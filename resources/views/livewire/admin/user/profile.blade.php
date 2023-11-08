<div>
    <div class="px-4 sm:px-6 lg:px-8 space-y-4">
        <x-breadcrumbs.main>
            <x-breadcrumbs.link>Profile</x-breadcrumbs.link>
        </x-breadcrumbs.main>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Profile</h1>
    </div>
    <div class="px-4 sm:px-6 space-y-6 max-w-4xl">
        <div class="p-4 mt-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-lg border dark:border-gray-700">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Profile Information') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Update your account's profile information and email address.") }}
                        </p>
                    </header>

                    <form wire:submit.prevent="saveProfileInformation" class="mt-6 space-y-6">
                        <div>
                            <x-label.input-label for="first_name" :required="true" :value="__('First Name')"></x-label.input-label>
                            <x-input.text
                                wire:model.lazy="user.first_name"
                                id="first_name" name="first_name" type="text"
                                class="mt-1 block w-full"
                                error="user.first_name"
                                required
                            />
                            <x-input-error error="user.first_name" class="mt-2" />
                        </div>

                        <div>
                            <x-label.input-label for="last_name" :required="true" :value="__('Last Name')"></x-label.input-label>
                            <x-input.text
                                wire:model.lazy="user.last_name"
                                id="last_name" name="last_name" type="text"
                                class="mt-1 block w-full"
                                error="user.last_name"
                                required
                            />
                            <x-input-error error="user.last_name" class="mt-2" />
                        </div>

                        <div>
                            <x-label.input-label for="email" :value="__('Email')" :required="true"/>
                            <x-input.text
                                wire:model.lazy="user.email"
                                id="email" name="email" type="email"
                                class="mt-1 block w-full"
                                error="user.email"
                                required
                            />
                            <x-input-error error="user.email" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-button.primary-button
                                wire:target="saveProfileInformation"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-70 cursor-wait"
                            >
                                <svg wire:loading wire:target="saveProfileInformation"
                                     class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ __('Save') }}
                            </x-button.primary-button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-lg border dark:border-gray-700">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Update Password') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Ensure your account is using a long, random password to stay secure.') }}
                        </p>
                    </header>

                    <form method="post" wire:submit.prevent="saveCredentials" class="mt-6 space-y-6">
                        <div>
                            <x-label.input-label for="current_password" :required="true" :value="__('Current Password')" />
                            <x-input.text
                                wire:model.lazy="currentPassword"
                                id="current_password" name="current_password" type="password"
                                class="mt-1 block w-full" autocomplete="current-password"
                                error="currentPassword"
                            />
                            <x-input-error error="currentPassword" class="mt-2" />
                        </div>

                        <div>
                            <x-label.input-label for="password" :required="true" :value="__('New Password')" />
                            <x-input.text
                                wire:model.lazy="password"
                                id="password" name="password" type="password"
                                class="mt-1 block w-full" autocomplete="password"
                                error="password"
                            />
                            <x-input-error error="password" class="mt-2" />
                        </div>

                        <div>
                            <x-label.input-label for="password_confirmation" :required="true" :value="__('Confirm Password')" />
                            <x-text-input
                                wire:model.lazy="passwordConfirmation"
                                id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" autocomplete="new-password"
                                error="passwordConfirmation"
                            />
                            <x-input-error error="passwordConfirmation" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-button.primary-button
                                wire:target="saveCredentials"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-70 cursor-wait"
                            >
                                <svg wire:loading wire:target="saveCredentials"
                                     class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ __('Save') }}
                            </x-button.primary-button>
                        </div>
                    </form>
                </section>

            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-lg border dark:border-gray-700">
            <div class="max-w-xl">
                <section class="space-y-6">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Delete Account') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                        </p>
                    </header>

                    <x-button.danger-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    >{{ __('Delete Account') }}</x-button.danger-button>

                    <x-modal name="confirm-user-deletion" focusable>
                        <form method="post" wire:submit.prevent="deleteAccount" class="p-6">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Are you sure you want to delete your account?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                            </p>

                            <div class="mt-6">
                                <x-label.input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                                <x-text-input
                                    wire:model.lazy="passwordConfirmationAccountDeletion"
                                    id="password" name="password" type="password"
                                    class="mt-1 block w-3/4"
                                    placeholder="{{ __('Password') }}"
                                />

                                <x-input-error error="passwordConfirmationAccountDeletion" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-button.secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-button.secondary-button>

                                <x-button.danger-button
                                    wire:target="saveCredentials"
                                    wire:loading.attr="disabled"
                                    wire:loading.class="opacity-70 cursor-wait"
                                    class="ml-3"
                                >
                                    <svg wire:loading wire:target="saveCredentials"
                                         class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ __('Delete Account') }}
                                </x-button.danger-button>
                            </div>
                        </form>
                    </x-modal>
                </section>
            </div>
        </div>
    </div>
</div>
