<!-- @deprecated -->
@props(['property', 'type' => 'text', 'focusHint' => null])

<div class="mt-4">
	<x-jet-label for="{{ $property }}" value="{{ __($langKey . $property) }}" class="text-base"/>
	<x-jet-input
		id="{{ $property }}"
		name="{{ $property }}"
		type="{{ $type }}"
		placeholder="{{ __($langKey . $property . '.placeholder') }}" 
		class="block mt-1 w-full peer"
		{{ $attributes }}
		:value="$model->$property"
		/>
	@if($focusHint)
		<label for="{{ $property }}" class="invisible peer-focus:visible"><small>{{ $focusHint }}</small></label>
	@endif
</div>