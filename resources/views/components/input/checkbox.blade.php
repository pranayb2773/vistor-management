@props([
    'disabled' => false,
    'error' => false
])

<input
    type="checkbox"
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'h-4 w-4 rounded'
            . ($errors->has($error) ? ' text-danger-500 border-gray-300 focus:ring-danger-500' : ' text-primary-500 border-gray-300 focus:border-primary-500 focus:ring-primary-500')
    ]) !!}
>
