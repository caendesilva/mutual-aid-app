<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if ($type)
                {{ __("Submit $Type") }}
            @else
            Please select type to continue
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4">
				@if ($type)
                    @include('listing.listing-form')
                @else
                    <div class="text-center">
                        <h3 class="font-semibold text-2xl text-gray-800 leading-tight mb-3">
                            Please select what kind of listing this is
                        </h3>
                        <div>
                            <x-button-link :to="(route('listings.create', ['type' => 'offer']))" class="mt-3 mx-2">
                                ⛑️ Offer
                            </x-button-link>
                            <x-button-link :to="(route('listings.create', ['type' => 'request']))" class="mt-3 mx-2">
                                🙋 Request
                            </x-button-link>
                        </div>
                    </div>
                @endif
			</div>
        </div>
    </div>
</x-app-layout>
