@props(['error' => ''])


@error($error)
<div {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        {{ $message }}
</div>
@enderror
