@include('partials.header')
    <section id="categories">
        <div class="items">
            <div class="breadcrumbs">
                <a href="/catalog">Каталог ЦСК</a>
                <span class="arrow">&gt;</span>
                <a href="/category/{{$category->id}}">{{$category->title}}</a>
                <span class="arrow">&gt;</span>
                <a href="/category/{{$subcategory->id}}">{{$subcategory->title}}</a>
                <span class="arrow">&gt;</span>
                <span>{{$product->name}}</span>
            </div>
            <div class="product-container">
                <h1>{{$product->name}}</h1>
                <div class="product-layout">
                    <div class="product-image" style="background-image: url('{{$product->images[0]['image']}}');"></div>
                    <div class="product-info">
                        @if($product->brand)
                        <div class="product-info-block">
                            <div class="product-info-key">Производитель</div>
                            <div class="product-info-value">{{$product->brand}}</div>
                        </div>
                        @endif
                        @if($product->code)
                        <div class="product-info-block">
                            <div class="product-info-key">Артикул</div>
                            <div class="product-info-value">{{$product->code}}</div>
                        </div>
                        @endif
                        @if($product->barcode)
                        <div class="product-info-block">
                            <div class="product-info-key">Штрихкод</div>
                            <div class="product-info-value">{{$product->barcode}}</div>
                        </div>
                        @endif
                        @if($product->description)
                        <div class="product-info-block">
                            <div class="product-info-key">Описание</div>
                            <div class="product-info-value">{!! nl2br($product->description)!!}</div>
                        </div>
                        @endif
                        <div class="product-price-block">
                            @if($product->in_stock)
                                <div class="product-price-value">{{round($product->price)}} р</div>
                            @else
                                <div>Временно нет в наличии</div>
                            @endif
                            @if($product->in_stock)
                                <div class="product-price-cart">
                                    Количество <input type="number" class="input-number" value="1">
                                    <a href="javascript:void(0);" class="cart-button">В корзину</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>