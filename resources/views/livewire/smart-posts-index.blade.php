<div class="flex flex-col md:flex-row overflow-hidden">
    <aside class="p-4 py-6" x-data="{ show: window.innerWidth > 768 }">
        <div class="p-4 bg-white shadow-lg rounded-lg">
            <header class="flex items-center mb-3">
                <h4 class="text-lg font-bold mr-2">Filters</h4>
            </header>
            <div>
                <x-jet-input type="search"  wire:model="search" placeholder="Search" title="Enter a search query"/>
            </div>
        </div>
    </aside>
    <section class="lg:ml-8">
        @if($models && $models->count())
        <div class="px-4 pt-3 md:hidden">
            {{ $models->links() }}
        </div>

        <div class="overflow-y-auto md:max-h-[75vh]">
            @foreach ($models as $model)
                @include('project.index-card')
            @endforeach
        </div>
             
        <footer class="m-4">
            <div class="hidden md:block pr-3 pt-3">
                {{ $models->links() }}
            </div>
        </footer>
        @else
        <div class="text-center">
            <br>
            <h3 class="text-center text-lg lg:text-xl py-3">Could not find any results! Try broadening your search?</h3>
            <button wire:click="$set('search', null)" title="Refresh the page without any filters">Clear Search Filters</button>
        </div>
        @endif
    </section>
</div>