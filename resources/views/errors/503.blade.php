@extends('errors::context')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))

@section('extra')
<p>{{ __('Sorry, we are doing some server maintenance. This should only take a few seconds. Please check back soon.') }}</p>
<p>
	<a href="">Refresh page</a>
</p>
@endsection