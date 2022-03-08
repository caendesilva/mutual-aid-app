<article class="m-4 my-6 p-4 lg:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
	<header>
		<h3 class="text-lg font-bold">
			<a href="{{ route($modelName. 's.show', $model) }}">{{ $model->subject }}</a>
		</h3>
		{{ ucwords($modelName) }}ed <x-time :carbon="$model->created_at" :niceDate="true" />
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