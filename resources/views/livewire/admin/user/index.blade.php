<div>
    <div class="px-4 sm:px-6 space-y-4">
        <!-- Bread crumbs -->
        <x-breadcrumbs.main>
            <x-breadcrumbs.link>{{ __('Users') }}</x-breadcrumbs.link>
        </x-breadcrumbs.main>

        <!-- Page Header -->
        <header class="space-y-2 items-end justify-between sm:flex sm:space-y-0 sm:space-x-4  sm:rtl:space-x-reverse">
            <!-- Page Title -->
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ __('Users') }}</h1>
            </div>

            <!-- Add Action -->
            <div class="flex flex-wrap items-center gap-4 justify-start shrink-0">
                <x-button.primary-button
                    wire:target="saveProfileInformation"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-70 cursor-wait"
                    class="!text-sm normal-case tracking-tight"
                >
                    <svg wire:loading wire:target="saveProfileInformation"
                         class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('New User') }}
                </x-button.primary-button>
            </div>
        </header>

        <!-- Page Body -->
        <div class="flex flex-col pt-2">
            <div
                class="border border-gray-300 shadow-sm bg-white rounded-xl filament-tables-container dark:bg-gray-800 dark:border-gray-700"
            >
                <!-- Table Header Container -->
                <div class="table-header-container flex justify-between p-2 h-14 gap-2">
                    <!-- Bulk Actions -->
                    <div class="flex items-center gap-2">
                        @if(!empty($selected))
                            <div class="table-bulk-action">
                                <x-dropdown.main align="left" width="w-48">
                                    <x-slot:trigger>
                                        <button title="Open actions" type="button"
                                                class="filament-icon-button flex items-center justify-center rounded-full relative outline-none hover:bg-gray-500/5 disabled:opacity-70 disabled:cursor-not-allowed disabled:pointer-events-none text-primary-600 focus:bg-primary-500/10 dark:hover:bg-gray-300/5 w-10 h-10"
                                        >
                                            <span class="sr-only">Open actions</span>
                                            <svg
                                                class="w-5 h-5"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" aria-hidden="true"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                            </svg>
                                        </button>
                                    </x-slot:trigger>

                                    <x-slot:content>
                                        <x-dropdown.button
                                            wire:click="$toggle('showDeleteModal')"
                                            type="button" class="space-x-2 hover:bg-danger-500 dark:hover:bg-danger-500"
                                        >
                                            <x-icon.trash class="text-danger-500 group-hover:text-gray-100"/>
                                            <span class="group-hover:text-gray-100">Delete Selected</span>
                                        </x-dropdown.button>
                                    </x-slot:content>
                                </x-dropdown.main>
                            </div>
                        @endif
                    </div>

                    <!-- Search Filters -->
                    <div class="flex items-center justify-end gap-2">
                        <div class="relative rounded-md group">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-500"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" aria-hidden="true"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                                </svg>
                            </div>
                            <x-input.text
                                wire:model.debounce="search"
                                type="search" placeholder="Search"
                                class="block w-full rounded-md border-0 py-1.5 pl-10 ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-500 sm:text-sm sm:leading-6"
                            />
                        </div>
                        <div wire:ignore>
                            <x-dropdown.main align="right" width="w-56" is-filter="true">
                                <x-slot:trigger>
                                    <button title="Open actions" type="button"
                                            class="filament-icon-button flex items-center justify-center rounded-full relative outline-none hover:bg-gray-500/5 disabled:opacity-70 disabled:cursor-not-allowed disabled:pointer-events-none text-primary-600 focus:bg-primary-500/10 dark:hover:bg-gray-300/5 w-10 h-10"
                                    >
                                        <span class="sr-only">Open actions</span>
                                        <svg
                                            class="filament-icon-button-icon w-5 h-5"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" aria-hidden="true"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                        </svg>
                                    </button>
                                </x-slot:trigger>

                                <x-slot:content>
                                    <div class="py-1 flex" role="none" wire:ignore>
                                        <div class="w-full px-2 py-2 text-sm text-gray-700" role="menuitem">
                                            <x-label.input-label for="filter-updated_at">Modified At</x-label.input-label>
                                            <x-date.date-time-picker wire:model.lazy="updatedAt" id="filter-updated_at" placeholder="MM/DD/YYYY"></x-date.date-time-picker>
                                        </div>
                                    </div>
                                </x-slot:content>
                            </x-dropdown.main>
                        </div>
                    </div>
                </div>

                @if(!empty($selected))
                    <!-- Multi Rows Selection Info -->
                    <div
                        wire:key="rows-selected-info"
                        class="bg-primary-500/10 px-4 py-2 whitespace-nowrap text-sm border-t dark:border-gray-700"
                    >
                        @unless ($selectAll)
                            <svg
                                wire:loading wire:target="selectAll"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="animate-spin inline-block w-4 h-4 mr-3 rtl:mr-0 rtl:ml-3 text-primary-500"
                                style="display: none;"
                            >
                                <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                                      d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                      fill="currentColor"></path>
                                <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"
                                      fill="currentColor"></path>
                            </svg>
                            <span class="dark:text-white">{{ count($selected) }} records selected.</span>
                            <span>
                                <button wire:click="selectAll" class="text-sm font-medium text-primary-600">
                                    Select all {{ $users->total() }}.
                                </button>
                            </span>
                            <span>
                                <button wire:click="$set('selectPage', false)" class="text-sm font-medium text-primary-600">
                                    Deselect all.
                                </button>
                            </span>
                        @else
                            <span class="dark:text-white">{{ $users->total() }} records selected.</span>
                            <span>
                                <button wire:click="$set('selectPage', false)" class="text-sm font-medium text-primary-600">
                                    Deselect all.
                                </button>
                            </span>
                        @endif
                    </div>
                @endif

                <!-- Users Table -->
                <div>
                    @if($users->isEmpty())
                        <div class="flex items-center justify-center p-4 border-t dark:border-gray-700">
                            <div class="flex flex-1 flex-col items-center justify-center p-6 mx-auto space-y-6 text-center bg-white dark:bg-gray-800">
                                <div class="flex items-center justify-center w-16 h-16 text-primary-500 rounded-full bg-primary-50 dark:bg-gray-700">
                                    <svg wire:loading.remove.delay="1" wire:target="search" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="animate-spin w-6 h-6" wire:loading.delay="wire:loading.delay" wire:target="search">
                                        <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="currentColor"></path>
                                        <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                                    </svg>
                                </div>

                                <div class="max-w-md space-y-1">
                                    <h2 class="text-xl font-bold tracking-tight dark:text-white">
                                        No records found
                                    </h2>
                                    <p class="whitespace-normal text-sm font-medium text-gray-500 dark:text-gray-400"></p>
                                </div>
                            </div>
                        </div>
                    @else
                        <x-table.main>
                            <!-- Table Headings -->
                            <x-slot name="head">
                                <x-table.heading class="pr-0 w-8">
                                    <x-input.checkbox wire:model="selectPage"></x-input.checkbox>
                                </x-table.heading>

                                <x-table.heading
                                    sortable multi-column
                                    wire:click="sortBy('first_name')"
                                    :direction="$sortColumn === 'first_name' ? $sortDirection : ''"
                                    class="w-full"
                                >Name</x-table.heading>

                                <x-table.heading>Roles</x-table.heading>

                                <x-table.heading
                                    sortable multi-column
                                    wire:click="sortBy('status')"
                                    :direction="$sortColumn === 'status' ? $sortDirection : ''"
                                >Status</x-table.heading>

                                <x-table.heading
                                    sortable multi-column
                                    wire:click="sortBy('user_type')"
                                    :direction="$sortColumn === 'user_type' ? $sortDirection : ''"
                                >Type</x-table.heading>

                                <x-table.heading
                                    sortable multi-column
                                    wire:click="sortBy('updated_at')"
                                    :direction="$sortColumn === 'updated_at' ? $sortDirection : ''"
                                >Modified At</x-table.heading>

                                <x-table.heading>Action</x-table.heading>
                            </x-slot>

                            <!-- Table Body -->
                            <x-slot:body>
                                @foreach($users as $user)
                                    <x-table.row wire:key="row-{{ $user->id }}" class="text-base">
                                        <x-table.cell class="pr-0">
                                            <x-input.checkbox wire:model="selected" value="{{ $user->id }}"></x-input.checkbox>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <dl>
                                                <dt class="sr-only">Display Name</dt>
                                                <dd class="font-medium text-gray-900 dark:text-gray-200">
                                                    {{ $user->first_name . ' ' . $user->last_name }}
                                                </dd>
                                                <dt class="sr-only">Email</dt>
                                                <dd class="text-gray-500 dark:text-gray-400">
                                                    {{ $user->email }}
                                                </dd>
                                            </dl>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <div>
                                                <ul class="space-y-2 list-disc">
                                                    @forelse($user->roles as $role)
                                                        <li class="px-2 text-sm font-medium">
                                                            {{ $role->name }}
                                                        </li>
                                                    @empty
                                                        <li>None</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-medium rounded-full {{ $user->status->color() }}">
                                                {{ $user->status->names() }}
                                            </span>
                                        </x-table.cell>

                                        <x-table.cell>{{ $user->user_type->names() }}</x-table.cell>

                                        <x-table.cell>
                                            <dl>
                                                <dt class="sr-only">Updated At</dt>
                                                <dd class="font-medium text-gray-700 dark:text-gray-200">
                                                    {{ $user->updated_at->format('F j, Y g:i a') }}
                                                </dd>
                                                <dt class="sr-only">Human readable</dt>
                                                <dd class="text-gray-500 dark:text-gray-400">
                                                    {{ $user->updated_at->diffForHumans() }}
                                                </dd>
                                            </dl>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <div class="flex items-center space-x-2">
                                                <x-icon.eye
                                                    wire:click="$emit('openModal', 'admin.user.view', {{ json_encode(['user' => $user->id], JSON_THROW_ON_ERROR) }})"
                                                    class="text-gray-400 dark:text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 cursor-pointer"
                                                />
                                                <x-icon.pencil
                                                    wire:click="$emit('openModal', 'admin.user.edit', {{ json_encode(['user' => $user->id], JSON_THROW_ON_ERROR) }})"
                                                    class="text-primary-600 hover:text-primary-500 cursor-pointer"/>
                                            </div>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforeach
                            </x-slot:body>
                        </x-table.main>
                    @endif
                </div>

                @if($users->isNotEmpty())
                    <!-- Pagination -->
                    <div class="px-4 py-2 border-t font-bold dark:border-gray-700">
                        {{ $users->links('vendor.pagination.tailwind', ['perPageAccepted' => $perPageAccepted]) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- User(s) Delete Confirmation Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal" id="confirm-user-deletion" max-width="lg" focusable>
            <x-slot name="title">Delete selected users</x-slot>

            <x-slot name="content">
                Are you sure you would like to do this?
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary-button wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary-button>

                <x-button.danger-button type="submit">Delete</x-button.danger-button>
            </x-slot>
        </x-modal.confirmation>
    </form>
</div>
