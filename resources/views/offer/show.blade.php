<x-app-layout>
    <x-slot name="header">
        <div class="flex row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Offer Details') }}
            </h2>
            @can('update', $offer)
            <a href="{{ route('offers.edit', $offer) }}">
                <x-jet-button>
                    Update Offer
                </x-jet-button>
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <article class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg flex ">
                <div class="max-w-5xl">
                    <header class="p-3">
                        <h1 class="text-2xl">
                            {{ $offer->subject }}
                        </h1>
                        Offered <time datetime="{{ $offer->created_at }}">{{ $offer->created_at }}</time>
                        by <address class="inline" rel="author" style="display: inline;">{{ $offer->user->name }}</address>.
                    </header>
                    <hr class="mx-3">
                    <div class="article-content prose p-3">
                        <h2 class="text-lg mb-1">Offer Details</h2>

                        {!! Str::markdown($offer->body ?? 'The offerer did not provide any further details.') !!}

                        <h3 class="text-base">What the offerer can provide</h3>

                        @if($offer->resources)
                        <ul>
                            @foreach ($offer->resources as $resource)
                            <li class="leading-4">
                                {{ ucwords($resource) }}
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <h4>
                            The offerer did not specify any resources.
                        </h4>
                        @endif

                    </div>
                </div>
                <aside class="p-3 mx-auto">
                    <h3 class="text-lg font-bold">
                        Location:
                    </h3>
                    <address>
                        {{ $offer->location }}
                    </address>
                    <x-open-street-map :search="$offer->location" />
                    
                </aside>
            </article>
        </div>
    </div>
</x-app-layout>