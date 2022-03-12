<article @class([
	'my-6 p-4 lg:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg w-full',
	])>
	<header>
		<div class="flex flex-row items-center justify-between">
		@includeWhen($listing->type === 'offer', 'components.badges.listing-type-offer')
		@includeWhen($listing->type === 'request', 'components.badges.listing-type-request')

		@if($listing->is_religious)
		<x-badges-religious-provider class="float-right" />
		@endif
		</div>
		
		<h3 class="text-lg font-bold">
			<a href="{{ route('listings.show', $listing) }}">{{ $listing->subject }}</a>
		</h3>
		{{ ucwords($listing->type) }}ed <x-time :carbon="$listing->created_at" :niceDate="true" />
		by <address class="inline" rel="author" style="display: inline;">{{ $listing->user->name }}</address>.
	</header>
	<div>
		@if($listing->resources)
		<strong>{{ $listing->type === 'offer' ? 'Provides' : 'Needs' }}:</strong>
		{{ ucwords(implode(', ', $listing->resources)) }}
		@endif
	</div>
	<footer class="mt-3">
		<a class="text-indigo-700" href="{{ route('listings.show', $listing) }}">View {{ ucwords($listing->type) }}</a>
		@can('update', $listing)
		<a class="text-indigo-700 mx-2 text-sm" href="{{ route('listings.edit', $listing) }}">Edit {{ ucwords($listing->type) }}</a>
		@endcan
	</footer>
</article>