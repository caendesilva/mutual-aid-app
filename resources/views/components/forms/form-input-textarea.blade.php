@props([
    'property',
    'type' => 'text',
    'value' => null,
    ])

<div>
	<x-jet-label for="{{ $property }}" value='{{ __("$langKey.$property") }}' class="text-base"/>
    <textarea 
        id="{{ $property }}"
        name="{{ $property }}"
		placeholder='{{ __("$langKey.$property.placeholder") }}' 
        {!! $attributes->merge(['class' => 'border-gray-400 focus:border-indigo-600
                focus:ring focus:ring-indigo-500 focus:ring-opacity-75 rounded-md shadow-sm block mt-1 w-full']) !!}
		{{ $attributes }}>{{ $value }}</textarea>
</div>