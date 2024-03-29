<div>
    <x-slot name="header">
        <div class="flex row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listings
            </h2>
           
            <div class="sm:hidden">
                <a href="{{ route('listings.create') }}" class="mx-1">
                    <x-jet-button>
                        {{ __('Submit a Listing') }}
                    </x-jet-button>
                </a>
            </div>
            <div class="hidden sm:block">
                @if(in_array('offer', $buttons))
                <a href="{{ route('listings.create', ['type' => 'offer']) }}" class="mx-1">
                    <x-jet-button>
                        {{ __('Submit an Offer') }}
                    </x-jet-button>
                </a>
                @endif
                @if(in_array('request', $buttons))
                <a href="{{ route('listings.create', ['type' => 'request']) }}" class="mx-1">
                    <x-jet-button>
                        {{ __('Submit a Request') }}
                    </x-jet-button>
                </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4">
            <div class="flex flex-col md:flex-row overflow-hidden">
                <aside class="p-4 py-6 w-full max-w-xs">
                    <div class="p-4 bg-white shadow-lg rounded-lg">
                        <header class="flex items-center mb-3">
                            <h4 class="text-lg font-bold mr-2">Filters</h4>
                        </header>
                        <div>
                            <noscript class="rounded-lg mb-4 bg-gray-100 text-sm" role="alert">
                                <!-- Component by Flowbite (MIT) -->
                                <div class="p-4 bg-yellow-300  text-yellow-900">
                                    <strong>Heads up!</strong> Your browser does not seem to have JavaScript enabled.
                                </div>
                                <div class="p-4">
                                    <p>JavaScript is required for the interactive search to work.</p>
                                    <p class="mt-2">
                                        You can learn how to enable JavaScript on this web page
                                        <a href="https://www.enable-javascript.com/" class="text-indigo-500"
                                            rel="nofollow noopener noreferrer">https://www.enable-javascript.com/</a>
                                    </p>
                                </div>
                            </noscript>
                        </div>
                        <div>
                            <x-jet-input type="search" wire:model="search" placeholder="Free text search"
                                aria-label="Free text search" title="Enter a search query" class="w-full" />
                        </div>
                        <hr class="my-4 mr-8">
                        <div>
                            <div class="m-1 flex items-center">
                                <fieldset>
                                    <div>
                                        <x-jet-checkbox wire:model="filterExcludeReligiousProviders"
                                            id="exclude_religious_providers" />
                                        <label for="exclude_religious_providers" class="ml-2 cursor-pointer">
                                            Exclude Religious Providers
                                        </label>
                                    </div>

                                    <div>
                                        <x-jet-checkbox wire:model="filterIncludeClosedListings"
                                            id="include_closed_listings" />
                                        <label for="include_closed_listings" class="ml-2 cursor-pointer">
                                            Include Closed Listings
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <hr class="my-4 mr-8">

                        <div>
                            <x-jet-label for="types" value="{{ __('Filter listing type') }}" />
                            <select wire:model="typeSelector" id="types"
                                class="border-gray-400 focus:border-indigo-600 focus:ring focus:ring-indigo-500 focus:ring-opacity-75 rounded-md shadow-sm block mt-1 w-full"
                                type="select" name="types">
                                <option value="both">Show Both</option>
                                <option value="offers">Offers Only ⛑️</option>
                                <option value="requests">Requests Only 🙋</option>
                            </select>
                        </div>
                    </div>
                </aside>
                <section class="py-3 px-4 lg:ml-8 w-full max-w-2xl">
                    @if($listings && $listings->count())
                    <div class="pt-3">
                        {{ $listings->onEachSide(1)->links() }}
                    </div>

                    <div>
                        @foreach ($listings as $listing)
                        @include('listing.listing-card')
                        @endforeach
                    </div>

                    <div class="pb-3 text-center pt-3">
                        @if($perPage < $listings->total())
                        <x-jet-button wire:click="loadMore" wire:loading.attr="disabled">Load More</x-jet-button>
                        @else
                            <p class="mb-3">
                                You've reched the end!
                            </p>
                            <a href="#top"><x-jet-secondary-button>Scroll to top</x-jet-secondary-button></a>
                        @endif
                    </div>
                    @else
                    <div class="text-center">
                        <br>
                        <h3 class="text-center text-lg lg:text-xl py-3">Could not find any results! Try broadening your
                            search?</h3>
                        <button wire:click="clearFilters()" title="Refresh the page without any filters">Clear
                            Search Filters</button>
                    </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</div>