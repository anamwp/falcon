<div class="page-content pb-15">
  @php(the_content())
</div>
@if ($pagination)
  <nav class="page-nav" aria-label="Page">
    {!! $pagination !!}
  </nav>
@endif
