<div>
	<div class="flex">
		<x-jet-label for="is_religious" value="{{ __('Is this offer from a religious organization?') }}" class="text-base" />
		<button type="button" class="mx-2 text-sm text-indigo-500" onclick="alert('We ask this so persons in need can filter offers depending on their preference.')">Why do we ask for this?</button>
	</div>
	<div class="flex items-center">
		<div class="m-1">
			<input type="radio" id="is_religious_false" name="is_religious" value="0">
			<label for="is_religious_false">No</label>
		</div>
		<div class="m-1">
			<input type="radio" id="is_religious_true" name="is_religious" value="1">
			<label for="is_religious_true">Yes</label>
		</div>
	</div>
</div>