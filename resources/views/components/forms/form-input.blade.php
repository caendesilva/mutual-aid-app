@props([
    'property',
    'type' => 'text',
    'value' => null,
	'hint' => null
    ])

<div>
	<x-jet-label for="{{ $property }}" value='{{ __("$langKey.$property") }}' class="text-base"/>
	<x-jet-input
		id="{{ $property }}"
		name="{{ $property }}"
		type="{{ $type }}"
		:value="old($property) ?? $value"
		placeholder='{{ __("$langKey.$property.placeholder") }}' 
		class="block mt-1 w-full"
		{{ $attributes }}
		/>
	@if($hint)
	<label for="{{ $property }}"><small>{{ $hint }}</small></label>
	@endif
</div>