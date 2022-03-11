<div class="flex flex-row -mx-2 mt-5 justify-end">
    @if($hasDeleteButton ?? false)
    <x-jet-danger-button type="button" class="m-2 mr-auto" wire:click="$toggle('confirmingModelDeletion')" wire:loading.attr="disabled">
        Delete
    </x-jet-danger-button>
    @endif
    <x-jet-secondary-button type="reset" class="m-2">
        Reset
    </x-jet-secondary-button>
    <x-jet-button type="submit" class="m-2">
        Submit
    </x-jet-button>
</div>