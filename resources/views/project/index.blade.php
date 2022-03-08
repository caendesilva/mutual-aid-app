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
                    @foreach ($models as $model)
                        <article class="m-4 my-6 p-4 lg:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <header>
                                <h3 class="text-lg font-bold">
                                    <a href="{{ route($modelName. 's.show', $model) }}">{{ $model->subject }}</a>
                                </h3>
                                {{ ucwords($modelName) }}ed <time datetime="{{ $model->created_at }} {{ $model->created_at->format('e') }}" title="{{ $model->created_at }} {{ $model->created_at->format('e') }}">{{ $model->niceDate }}</time>
                                by <address class="inline" rel="author" style="display: inline;">{{ $model->user->name }}</address>.
                            </header>
                            <div>
                                @if($model->resources)
                                <strong>Needs:</strong>
                                {{ ucwords(implode(', ', $model->resources)) }}
                                @endif
                            </div>
                            <footer class="mt-3">
                                <a class="text-indigo-700" href="{{ route($modelName. 's.show', $model) }}">View {{ ucwords($modelName) }}</a>
                                @can('update', $model)
                                <a class="text-indigo-700 mx-2 text-sm" href="{{ route($modelName. 's.edit', $model) }}">Edit {{ ucwords($modelName) }}</a>
                                @endcan
                            </footer>
                        </article>
                    @endforeach

                    <footer class="m-4">
                        {{ $models->links() }}
                    </footer>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
