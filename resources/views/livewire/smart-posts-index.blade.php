<div class="flex overflow-hidden">
    <aside class="p-4 py-6">
        <div class="p-4 bg-white shadow-lg rounded-lg">
            <h4 class="text-lg font-bold mb-3">Filters</h4>
            <x-jet-input type="search"  wire:model="search" placeholder="Search" title="Enter a search query"/>
        </div>
    </aside>
    <section class="ml-8">
        @if($models && $models->count())
        <div class="overflow-y-auto" style="max-height: 75vh">
            @foreach ($models as $model)
                @include('project.index-card')
            @endforeach
        </div>
             
        <footer class="m-4">
            {{ $models->links() }}
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