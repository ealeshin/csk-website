@include('partials.header')
<section id="mp-catalog">    
    <div class="items">
        <div class="items-heading">
            @if($count > 0)
                <h3>Найдено товаров: {{$count}}</h3>
            @else
                <h3>По вашему запросу ничего не найдено</h3>
            @endif
        </div>
        @if($count > 0)
            @foreach($products as $product)
            <div class="card">
                <div class="card-image" style="background-image: url('{{$product->images[0]['image']}}');"></div>
                <div class="card-title">{{$product->name}}</div>
                <a class="card-more" href="/product/{{$product->id}}">Подробнее о товаре</a>
            </div>
            @endforeach
        @endif
    </div>
</section>
@include('partials.footer')