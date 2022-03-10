<x-app-layout>
    <x-slot name="header">
        <div class="flex row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __(ucwords($modelName) . ' Index') }}
            </h2>
            <a href="{{ route($modelName. 's.create') }}">
                <x-jet-button>
                    {{ __('Submit ' . ucwords($modelName)) }}
                </x-jet-button>
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($modelName === 'offer')
            @livewire('smart-posts-index')
            @endif

            {{-- <div class="">
                <header class="flex mx-4">
                    @if($modelName === 'offer')
                    <form class="flex ml-auto" action="" method="GET">
                        <x-jet-label for="religion">
                            <div class="flex items-center">
                                <div class="mr-2">
                                    {{ __('Include offers from religous providers') }}
                                </div>
                                <x-jet-checkbox
                                name="includeReligiousProviders"
                                id="includeReligiousProviders"
                                title="Click to toggle"
                                value="true"
                                :checked="$includeReligiousProviders"
                                onchange="this.form.submit()"
                                />
                            </div>
                        </x-jet-label>
                        <noscript>
                            <button class="text-right ml-2" type="submit" title="Save your preference">Update</button>
                        </noscript>
                    </form>
                    @endif
                </header>
                
                <section>
                    @if($models->count())
                        @foreach ($models as $model)
                            @include('project.index-card')
                        @endforeach
                    @else
                    <div class="text-center">
                        <br>
                        <h3 class="text-center text-lg lg:text-xl py-3">Could not find any results! Try broadening your search?</h3>
                        <a href="{{ request()->url() }}" title="Refresh the page without any filters">Clear Search Filters</a>
                    </div>
                    @endif
                </section>
                
                <footer class="m-4">
                    {{ $models->links() }}
                </footer>
            </div> --}}
        </div>
    </div>
</x-app-layout>
