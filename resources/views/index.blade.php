@include('partials.header')
@include('partials.slider')
@include('partials.categories')
    <section id="mp-catalog">
        <div class="items">
            @foreach($products as $product)
            <a class="card">
                <div class="card-image" style="background-image: url('{{$product->images[0]['image']}}');"></div>
                <div class="card-title">{{$product->name}}</div>
                <div class="card-more">Подробнее о товаре</div>
            </a>
            @endforeach
        </div>
    </section>
</body>
</html>