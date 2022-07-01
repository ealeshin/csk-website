<div class="swiper">
    <div class="swiper-wrapper">
        @foreach(\App\Models\Slide::getArray() as $url)
            <div class="swiper-slide" style="background-image: url('{{$url}}')"></div>
        @endforeach
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>