@include('partials.header')
@include('partials.slider')
@include('partials.categories')
    <section id="mp-catalog">
        <div class="items">
            @foreach($products as $product)
            <div class="card">
                <div class="card-image" style="background-image: url('{{$product->images[0]['image']}}');"></div>
                <div class="card-title">{{$product->name}}</div>
                <a class="card-more" href="product/{{$product->id}}">Подробнее о товаре</a>
            </div>
            @endforeach
        </div>
    </section>
    <section>
        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Ae218008c5bcb0b7630c1d128a103864269c2a3eda31fd3440827c2f8097cbac4&amp;source=constructor" width="640" height="400" frameborder="0"></iframe>
    </section>
</body>
</html>