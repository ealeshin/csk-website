@include('partials.header')
@if($count > 0)
<h2>Найдено товаров: {{$count}}</h2>
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
@else
<h2>По вашему запросу ничего не найдено</h2>
@endif
@include('partials.footer')