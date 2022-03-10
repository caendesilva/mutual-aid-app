<div>
    <x-slot name="header">
        <div class="flex row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listings
            </h2>
            <a href="{{ route('listings.create') }}">
                {{-- Buttons that show depends on the role --}}
                <x-jet-button>
                    {{ __('Submit a Listing') }}
                </x-jet-button>
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row overflow-hidden">
                <aside class="p-4 py-6">
                    <div class="p-4 bg-white shadow-lg rounded-lg">
                        <header class="flex items-center mb-3">
                            <h4 class="text-lg font-bold mr-2">Filters</h4>
                        </header>
                        <div>
                            <x-jet-input type="search"  wire:model="search" placeholder="Search" title="Enter a search query"/>
                        </div>
                    </div>
                </aside>
                <section class="py-3 px-4 lg:ml-8">
                    @if($listings && $listings->count())
                    <div class="pt-3">
                        {{ $listings->onEachSide(1)->links() }}
                    </div>
                    
                    <div>
                        @foreach ($listings as $listing)
                        @include('listing.single-listing-preview-card')
                        @endforeach
                    </div>
                    
                    <div class="pb-3 text-center pt-3">
                        <x-jet-button>Load More</x-jet-button>
                    </div>
                    @else
                    <div class="text-center">
                        <br>
                        <h3 class="text-center text-lg lg:text-xl py-3">Could not find any results! Try broadening your search?</h3>
                        <button wire:click="$set('search', null)" title="Refresh the page without any filters">Clear Search Filters</button>
                    </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</div>