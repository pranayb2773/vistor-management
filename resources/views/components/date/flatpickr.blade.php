@props([
    'disabled' => false,
    'error' => false,
    'helpText' => false,
    'enableTime' => false,
])

<div
    class="relative flex rounded-md shadow-sm mt-1"
    wire:ignore
>
    <input
        x-data = "{
            value: @entangle($attributes->wire('model')),
            init() {
                let picker = flatpickr(this.$refs.input, {
                    dateFormat: @if($enableTime) `d-m-Y h:i K` @else `d-m-Y` @endif,
                    defaultDate: this.value,
                    disableMobile: 'true',
                    enableTime: {{ $enableTime ? 'true' : 'false' }},
                    onChange: (date, dateString) => {
                        this.value = dateString;
                    }
                })

                this.$watch('value', () => picker.setDate(this.value) ?? '')
            }
        }"
        x-ref="input"
        {{ $disabled ? 'disabled'  : '' }}
        {!! $attributes->merge([
            'class' => 'appearance-none block w-full rounded-md border-0 px-3 py-2 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'
            . ($errors->has($error) ? ' border-danger focus:ring-danger focus:border-danger': ' border-gray-300 focus:ring-primary focus:border-primary')
            . ($disabled ? ' bg-slate-100' : '')
        ]) !!}
    />

    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M6 2C5.44772 2 5 2.44772 5 3V4H4C2.89543 4 2 4.89543 2 6V16C2 17.1046 2.89543 18 4 18H16C17.1046 18 18 17.1046 18 16V6C18 4.89543 17.1046 4 16 4H15V3C15 2.44772 14.5523 2 14 2C13.4477 2 13 2.44772 13 3V4H7V3C7 2.44772 6.55228 2 6 2ZM6 7C5.44772 7 5 7.44772 5 8C5 8.55228 5.44772 9 6 9H14C14.5523 9 15 8.55228 15 8C15 7.44772 14.5523 7 14 7H6Z"/>
        </svg>
    </div>
</div>
