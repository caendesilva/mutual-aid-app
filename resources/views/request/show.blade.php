<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Details') }}
        </h2>
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
                        by <address class="inline" rel="author">{{ $request->user->name }}</address>.
                    </header>
                    <hr class="mx-3 w-2/3">
                    <div class="article-content prose p-3">
                        <h2 class="text-lg mb-1">Request Details</h2>

                        {!! Str::markdown($request->body) !!}

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
                    <h2 class="text-lg font-bold">
                        Location:
                    </h2>
                    <address>
                        {{ $request->location }}
                    </address>
                    <iframe class="w-auto mt-3" width="425" height="256" frameborder="0" scrolling="no" marginheight="0"
                        marginwidth="0"
                        src="https://www.openstreetmap.org/export/embed.html?bbox=12.030715942382814%2C55.50958267610294%2C12.937088012695314%2C55.86336763758299&amp;layer=mapnik"
                        style="border: 1px solid black">
                    </iframe>
                    <small>
                        <a href="https://www.openstreetmap.org/#map=11/55.6869/12.4839"
                            title="Links to external site">Show bigger map</a>
                    </small>
                </aside>
            </article>
        </div>
    </div>
</x-app-layout>