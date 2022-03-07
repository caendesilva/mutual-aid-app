@props(['value', 'checked' => false])

<div class="m-1 flex items-center">
	<x-jet-checkbox id="resources.{{ $value }}" name="resources[]" value="{{ $value }}" :checked="$checked" class="peer cursor-pointer"/>
	<label for="resources.{{ $value }}" class="ml-1 cursor-pointer">
	{{ __(ucwords($value)) }}
	</label>
	<small class="invisible peer-checked:visible ml-2">{{ __($langKey . 'resource.' . $value . '.description') }}</small>
</div>