@props(['legend'])

<fieldset name="{{ Str::kebab($legend) }}" class="flex flex-col space-y-3 mb-4">
    <legend class="font-bold">{{ __($legend) }}</legend>

    {{ $slot }}
</fieldset>
