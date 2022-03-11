@props([
    'property',
    'value',
    'label',
    'checked' => false
    ])

@php($label = $label ?? ucwords($value))

<div class="m-1 flex items-center">
	<x-jet-checkbox :id='"$property.$value"' name="{{ $property }}[]" value="{{ $value }}" :checked="$checked" />
	<label for="resources.{{ $value }}" class="ml-2 cursor-pointer">
	{{ __($label) }}
	</label>
</div>