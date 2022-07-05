@include('partials.header')
    <section id="categories">
        <div class="catalog">
            <div class="sidebar">
                <div class="sidebar-link bp">
                    <a href="#">Все товары</a>
                </div>
                <div class="sidebar-link">
                    <a href="#">Первая категория</a>
                </div>
                <div class="sidebar-link">
                    <a href="#">Вторая категория</a>
                </div>
                
            </div>
            <div class="items">
                @foreach($products as $product)
                <div class="card">
                    <div class="card-image" style="background-image: url('{{$product->images[0]['image']}}');"></div>
                    <div class="card-title">{{$product->name}}</div>
                    <a class="card-more" href="/product/{{$product->id}}">Подробнее о товаре</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>