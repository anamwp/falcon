<div class="flex justify-between items-center text-sm text-gray-600 mb-2">
  <time class="dt-published" datetime="{{ get_post_time('c', true) }}">
    {{ get_the_date() }}
  </time>

  <p class="">
    <span>{{ __('By', 'sage') }}</span>
    <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" class="capitalize font-semibold p-author h-card">
      {{ get_the_author() }}
    </a>
  </p>
</div>
