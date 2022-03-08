<x-jet-form-section submit="updateRoles">
    <x-slot name="title">
        {{ __('Update Role') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account role') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="roles" value="{{ __('Select Role') }}" />
            <select wire:model="roles" id="roles" class="border-gray-400 focus:border-indigo-600 focus:ring focus:ring-indigo-500 focus:ring-opacity-75 rounded-md shadow-sm block mt-1 w-full" type="select" name="roles">
                <option value="pin">Person In Need</option>
                <option value="map">Mutual Aid Provider</option>
                <option value="both">Both</option>
            </select>
            <x-jet-input-error for="roles" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
