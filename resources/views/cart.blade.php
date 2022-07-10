@include('partials.header')
    <section id="cart">
        <div class="cart">
            <h3 class="empty-cart-message" @if(count($items) == 0) style="display: block;" @endif>Корзина пуста</h3>
            @php $total = 0; @endphp
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
                    <div class="cart-block-value sum">
                        @php
                            $sum = $item['count'] * $item['product']->price;
                            $total += $sum;
                        @endphp
                        {{number_format($sum, 2, ',', ' ')}}
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
            @if(count($items) > 0)
                <div class="cart-item cart-result">
                    <div class="cart-image cart-image-blank"></div>
                    <div class="cart-product">
                    </div>
                    <div class="cart-block-column">
                    </div>
                    <div class="cart-block-column">
                    </div>
                    <div class="cart-block-column">
                        <div class="cart-block-title">Итого</div>
                        <div class="cart-block-value result">{{number_format($total, 2, ',', ' ')}}</div>
                    </div>
                    <div class="cart-block-column order-button-column">
                        <div class="cart-block-title">&nbsp;</div>
                        <a href="javascript:void(0);" class="button order-button">Оформить заказ</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</body>
</html>