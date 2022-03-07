<x-app-layout>
    <x-slot name="header">
        <div class="flex row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Request Details') }}
            </h2>
            @can('update', $request)
            <a href="{{ route('requests.edit', $request) }}">
                <x-jet-button>
                    Update Request
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
                            {{ $request->subject }}
                        </h1>
                        Requested <time datetime="{{ $request->created_at }}">{{ $request->created_at }}</time>
                        by <address class="inline" rel="author" style="display: inline;">{{ $request->user->name }}</address>.
                    </header>
                    <hr class="mx-3">
                    <div class="article-content prose p-3">
                        <h2 class="text-lg mb-1">Request Details</h2>

                        {!! Str::markdown($request->body ?? 'The requester did not provide any further details.') !!}

                        <h3 class="text-base">What the requester needs</h3>

                        @if($request->resources)
                        <ul>
                            @foreach ($request->resources as $resource)
                            <li class="leading-4">
                                {{ ucwords($resource) }}
                            </li>
                            @endforeach
                        </ul>
                        @endif

                    </div>
                </div>
                <aside class="p-3 mx-auto">
                    <h3 class="text-lg font-bold">
                        Location:
                    </h3>
                    <address>
                        {{ $request->location }}
                    </address>
                    <x-open-street-map :search="$request->location" />
                    
                </aside>
            </article>
        </div>
    </div>
</x-app-layout>