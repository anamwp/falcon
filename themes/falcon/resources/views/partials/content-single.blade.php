<article @php(post_class('h-entry w-3/5 mx-auto py-10'))>
  <header class="mb-5">
    <h1 class="p-name text-3xl font-bold font-roboto text-slate-700 mb-1">
      {!! $title !!}
    </h1>

    @include('partials.entry-meta')
  </header>

  @if (has_post_thumbnail())
    <div class="mb-5 post-featured-image">
      @php(the_post_thumbnail('large', ['class' => 'w-full h-auto']))
    </div>
  @endif

  <div class="e-content single-post-content mb-5">
    @php(the_content())
  </div>

  @if ($pagination)
    <footer class="mt-5">
      <nav class="page-nav" aria-label="Page">
        {!! $pagination !!}
      </nav>
    </footer>
  @endif

  @php(comments_template())
</article>
