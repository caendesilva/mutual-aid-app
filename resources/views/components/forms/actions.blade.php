<div class="flex flex-row flex-wrap -mx-2 mt-5 justify-start sm:justify-end">
    @if($auxiliaryButtons ?? false)
    <div class="mr-3 sm:mr-auto sm:ml-0">
        {{ $auxiliaryButtons }}
    </div>
    @endif

    <div>
        <x-jet-secondary-button type="reset" class="m-2">
            Reset
        </x-jet-secondary-button>
        <x-jet-button type="submit" class="m-2">
            Submit
        </x-jet-button>
    </div>
</div>