<x-app-layout>
    <x-slot name="header">
        <div class="flex row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("$Type Details") }}
            </h2>
            @can('update', $listing)
            <div class="ml-3 relative">
                <x-jet-dropdown align="right">
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                <x-jet-button>
                                    {{ __("Manage $Type") }}
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </x-jet-button>
                            </button>
                        </span>
                    </x-slot>

                    <x-slot name="content">
                        <div>
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __("Manage $Type") }}
                            </div>
                            
                            <x-jet-dropdown-link href="{{ route('listings.edit', $listing) }}">
                                <div class="inline-flex">
                                    {{ __("Update $Type") }}
                                    <!-- Icons by Google Material Icons (License Apache 2.0) -->
                                    <svg class="fill-indigo-500 ml-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                </div>    
                            </x-jet-dropdown-link>

                            @can('delete', $listing)
                            <x-jet-dropdown-link href="{{ route('listings.edit', ['listing' => $listing, 'confirmingModelDeletion' => true]) }}">
                                <div class="inline-flex">
                                    {{ __("Delete $Type") }}
                                    <!-- Icons by Google Material Icons (License Apache 2.0) -->
                                    <svg class="fill-red-500 ml-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                </div>    
                            </x-jet-dropdown-link>
                            @endcan

                            <x-jet-dropdown-link href="{{ route('listings.edit', $listing) }}">
                                <div class="inline-flex">
                                    {{ __("Mark as Solved") }}
                                    <!-- Icons by Google Material Icons (License Apache 2.0) -->
                                    <svg class="fill-green-500 ml-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                </div>    
                            </x-jet-dropdown-link>
                        </div>
                    </x-slot>
                </x-jet-dropdown>
            </div>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <article class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-col sm:flex-row">
                <div class="max-w-5xl">
                    <header class="p-3">
                        <h1 class="text-2xl">
                            {{ $listing->subject }}
                        </h1>
                        {{ __("{$Type}ed") }} <time datetime="{{ $listing->created_at }}">{{ $listing->created_at }}</time>
                        by <address class="inline" rel="author">{{ $listing->user->name }}</address>.
                        @includeWhen(($listing->type === 'offer' && optional($listing->metadata)->is_religious), 'components.badges-religious-provider', ['attributes' => 'class=inline'])
                    </header>
                    <hr class="mx-3">
                    <div class="article-content prose p-3">
                        <h2 class="text-lg mb-1">{{ __("$Type Details") }}</h2>

                        {!! Str::markdown($listing->body ?? __("The {$type}er did not provide any further details.")) !!}

                        <h3 class="text-base">What the {{ __("{$type}er") }} can provide</h3>

                        @if($listing->resources)
                        <ul>
                            @foreach ($listing->resources as $resource)
                            <li class="leading-4">
                                {{ ucwords($resource) }}
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <blockquote>
                            {{ __("The {$type}er did not specify any resources.") }}
                        </blockquote>
                        @endif


                        @if($listing->contacts)
                        <h3 class="text-base font-bold">Contact information</h3>
                            @guest
                            <blockquote>
                                Please <x-link :to="route('login')">log in</x-link>
                                or <x-link :to="route('register')">register for an account</x-link>
                                to view contact information.
                            </blockquote>
                            @endguest
                            @auth
                                <div class="prose-p:my-1">
                                    {!! str_replace(
                                        '<a href="http',
                                        '<a rel="external nofollow noopener" href="http',
                                        Str::markdown(nl2br($listing->contacts)))
                                    !!}
                                </div>

                                @if(str_contains($listing->contacts, 'http'))
                                    <small>Be careful when visiting external links!</small>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
                <aside class="p-3 sm:mx-auto">
                    <h3 class="text-lg font-bold">Location:</h3>
                    <address>{{ $listing->location }}</address>
                    <x-open-street-map :search="$listing->location" />
                </aside>
            </article>
        </div>
    </div>
</x-app-layout>