@props([
    'disabled' => false,
    'error' => false
])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'dark:text-gray-300 dark:bg-gray-900 rounded-md shadow-sm ' . ($errors->has($error) ? 'border-danger-400 dark:border-danger-400 focus:border-danger-500 dark:focus:border-danger-500 focus:ring-danger-500 dark:focus:ring-danger-500' : 'border-gray-300 dark:border-gray-700 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-primary-500 dark:focus:ring-primary-500')
    ]) !!}
>
