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
            <div class="">
                @if($models->count())
                    <section>
                        @foreach ($models as $model)
                            @include('project.index-card')
                        @endforeach
                    </section>

                    <footer class="m-4">
                        {{ $models->links() }}
                    </footer>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
