<x-app-layout>
    <x-slot name="header">
        <div class="flex row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Offers Index') }}
            </h2>
            <a href="{{ route('offers.create') }}">
                <x-jet-button>
                    Submit Offer
                </x-jet-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                @if($offers->count())
                    @foreach ($offers as $offer)
                        <article class="m-4 my-6 p-4 lg:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <header>
                                <h3 class="text-lg font-bold">
                                    <a href="{{ route('offers.show', $offer) }}">{{ $offer->subject }}</a>
                                </h3>
                                Offered <time datetime="{{ $offer->created_at }}">{{ $offer->created_at }}</time>
                                by <address class="inline" rel="author" style="display: inline;">{{ $offer->user->name }}</address>.
                            </header>
                            <div>
                                @if($offer->resources)
                                <strong>Offers:</strong>
                                {{ ucwords(implode(', ', $offer->resources)) }}
                                @endif
                            </div>
                            <footer class="mt-3">
                                <a class="text-indigo-700" href="{{ route('offers.show', $offer) }}">View offer</a>
                                @can('update', $offer)
                                <a class="text-indigo-700 mx-2 text-sm" href="{{ route('offers.edit', $offer) }}">Edit offer</a>
                                @endcan
                            </footer>
                        </article>
                    @endforeach
                    
                    <footer class="m-4">
                        {{ $requests->links() }}
                    </footer>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
