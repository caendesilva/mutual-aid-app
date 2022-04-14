@extends('errors::context')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))


@section('extra')
<p>{{ __('Sorry, this was unexpected. Something went wrong on our end. The incident has been logged and we will look into it.') }}</p>
<p>
	<a href="{{ route('home') }}">Go to home page</a>
</p>
@endsection