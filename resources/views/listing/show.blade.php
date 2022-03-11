<x-app-layout>
    <x-slot name="header">
        <div class="flex row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("$Type Details") }}
            </h2>
            @can('update', $listing)
            <a href="{{ route('listings.edit', $listing) }}">
                <x-jet-button>
                	{{ __("Update $Type") }}
                </x-jet-button>
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <article class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg flex">
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
                <aside class="p-3 mx-auto">
                    <h3 class="text-lg font-bold">Location:</h3>
                    <address>{{ $listing->location }}</address>
                    <x-open-street-map :search="$listing->location" />
                </aside>
            </article>
        </div>
    </div>
</x-app-layout>