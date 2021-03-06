<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Update Listing") }}
        </h2>
        <x-slot name="headerActions">
            {{-- @todo implement header actions --}}
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

    <x-jet-dialog-modal wire:model="confirmingMarkedAsSolved">
        <x-slot name="title">
            {{ __("Mark " . ucwords($listing->type) . " as solved" ) }}
        </x-slot>
    
        <x-slot name="content">
            @if($listing->type === 'offer')
                If your offer is no longer applicable or available, 
                please press the green button to mark the offer as solved!

                This will archive the post and free up the listing page
                for new offers. Please note that this action can't
                be undone, though you can always post another one!
            @else  
                If you have recieved aid and/or don't need the listing anymore,
                please press the green button to mark the request as solved!

                This will archive the post and free up the listing page
                for new requests. Please note that this action can't
                be undone, though you can always post another one!
            @endif
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button class="m-2" wire:click="$toggle('confirmingMarkedAsSolved')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>
        
            <x-jet-button type="submit" class="m-2 bg-green-500 hover:bg-green-600" wire:click="markAsSolved" wire:loading.attr="disabled">
                {{ __('Mark as Solved') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
