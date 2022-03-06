<x-app-layout>
    <x-slot name="header">
        <div class="flex row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Request Index') }}
            </h2>
            <a href="{{ route('requests.create') }}">
                <x-jet-button>
                    Submit Request
                </x-jet-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                @if($requests->count())
                    @foreach ($requests as $request)
                        <article class="m-4 my-6 p-4 lg:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <header>
                                <h3 class="text-lg font-bold">
                                    <a href="{{ route('requests.show', $request) }}">{{ $request->subject }}</a>
                                </h3>
                                Requested <time datetime="{{ $request->created_at }}">{{ $request->created_at }}</time>
                                by <address class="inline" rel="author" style="display: inline;">{{ $request->user->name }}</address>.
                            </header>
                            <div>
                                @if($request->resources)
                                <strong>Needs:</strong>
                                {{ ucwords(implode(', ', $request->resources)) }}
                                @endif
                            </div>
                            <footer class="mt-3">
                                <a class="text-indigo-700" href="{{ route('requests.show', $request) }}">View Request</a>
                            </footer>
                        </article>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
