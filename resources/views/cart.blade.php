@include('partials.header')
    <section id="cart">
        <div class="cart">
            @foreach($items as $item)
            <div class="cart-item" data-cart-id="{{$item['product']->id}}">
                <div class="cart-image" style="background-image: url('{{$item['product']->images[0]['image']}}');">
                </div>
                <div class="cart-product">
                    <div class="cart-block-title">Товар</div>
                    <div class="cart-block-value product-name">
                        <a href="/product/{{$item['product']->id}}">{{$item['product']->name}}</a>
                    </div>
                </div>
                <div class="cart-block-column">
                    <div class="cart-block-title">Цена</div>
                    <div class="cart-block-value">
                        {{number_format($item['product']->price, 2, ',', ' ')}}
                    </div>
                </div>
                <div class="cart-block-column">
                    <div class="cart-block-title">Количество</div>
                    <div class="cart-block-value">{{$item['count']}}</div>
                </div>
                <div class="cart-block-column">
                    <div class="cart-block-title">Сумма</div>
                    <div class="cart-block-value">
                        {{number_format($item['count'] * $item['product']->price, 2, ',', ' ')}}
                    </div>
                </div>
                <div class="cart-block-column">
                    <div class="cart-block-title">&nbsp;</div>
                    <div class="cart-block-value">
                        <a href="javascript:void(0);" data-id="{{$item['product']->id}}"
                                class="delete-from-cart" title="Убрать из корзины">
                            <i class="la la-trash-alt nav-icon"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</body>
</html>