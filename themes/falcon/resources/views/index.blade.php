@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'sage') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endif
	<div class="grid grid-cols-4 gap-4">
		@while(have_posts()) @php(the_post())
			@includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
		@endwhile
	</div>
	<div class="navigation my-5 ">
		{!! get_the_posts_navigation() !!}
	</div>
@endsection

{{-- @section('sidebar')
  @include('sections.sidebar')
@endsection --}}
