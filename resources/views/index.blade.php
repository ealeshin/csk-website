@include('partials.header')
@include('partials.slider')
@include('partials.categories')
    <section id="mp-catalog">
        <div class="items">
            @foreach($products as $product)
            <div class="card">
                <div class="card-image" style="background-image: url('{{$product->images[0]['image']}}');"></div>
                <div class="card-title">{{$product->name}}</div>
                <a class="card-more" href="/product/{{$product->id}}">Подробнее о товаре</a>
            </div>
            @endforeach
        </div>
    </section>
    @if($partners->count() > 0)
    <section>
        <div class="text-container centered">
            <h1 class="alt-heading">Наши партнёры</h1>
            @foreach ($partners as $partner)
                <a href="{{$partner->link}}" target="_blank">
                    <img src="{{$partner->image}}" width="248" alt="{{$partner->name}}">
                </a>
            @endforeach
        </div>
    </section>
    @endif
@include('partials.footer')