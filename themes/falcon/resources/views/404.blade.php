@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, but the page you are trying to view does not exist.', 'sage') !!}
    </x-alert>
    <div class="search-box mt-5">
      {!! get_search_form(false) !!}
    </div>
  @endif
@endsection
