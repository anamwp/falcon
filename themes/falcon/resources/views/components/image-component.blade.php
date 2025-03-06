{{-- this is how component need to added inside blade view file --}}
{{-- <x-image-component :image-id="$image_id" image-alt-text="Image with alt text" image-size="full" /> --}}

<div {{ $attributes }}>
    {{-- Render Image with src --}}
    {!! $imageUrl !!}
</div>