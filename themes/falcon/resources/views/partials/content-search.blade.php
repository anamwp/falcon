<article @php(post_class())>
  <header>
    <h2 class="entry-title font-bold text-xl font-roboto">
      <a href="{{ get_permalink() }}" class="hover:underline">
        {!! $title !!}
      </a>
    </h2>

    @includeWhen(get_post_type() === 'post', 'partials.entry-meta')
  </header>

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
</article>
