<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Update Listing") }}
        </h2>
        <x-slot name="headerActions">
            <a href="{{ route('listings.show', $listing) }}">
                <x-jet-secondary-button>
                    Cancel
                </x-jet-secondary-button>
            </a>
        </x-slot>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4">
				@include('listing.listing-form')
			</div>
        </div>
    </div>

    <x-jet-confirmation-modal wire:model="confirmingModelDeletion">
        <x-slot name="title">
            Delete Listing
        </x-slot>
    
        <x-slot name="content">
            Are you sure you want to delete this listing? This cannot be undone!
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingModelDeletion')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>
    
            <form action="{{ route('listings.destroy', $listing) }}" method="POST">
                @csrf
                @method("DELETE")
                <x-jet-danger-button class="ml-3" wire:loading.attr="disabled" type="submit">
                    Delete Listing
                </x-jet-danger-button>
            </form>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
