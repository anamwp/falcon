<article @php(post_class( 'bg-slate-200 p-5 rounded-md transition-all hover:bg-slate-300' ))>
  <div class="thumbnail-image mb-3 inline-block rounded overflow-hidden">
    <x-image-component :image-id="get_post_thumbnail_id()" />
  </div>
  <header>
    @include('partials.entry-meta')
    <h2 class="entry-title mb-2">
      <a href="{{ get_permalink() }}" class="no-underline text-base font-semibold text-slate-700">
        {!! $title !!}
      </a>
    </h2>
  </header>

  <div class="entry-summary mt-2 line-clamp-3 text-gray-600">
    @php(the_excerpt())
  </div>
</article>
