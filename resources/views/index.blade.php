@include('partials.header')
@include('partials.slider')
    <section id="categories">
        <div class="items">
            <div class="category">
                <a href="#" class="root-category">Лакокрасочные материалы</a><br>
                <a href="#">Акриловые составы</a><br>
                <a href="#">Декоративные покрытия</a><br>
                <a href="#">Пены монтажные и герметики</a><br>
            </div>
            <div class="category">
                <a href="#" class="root-category">Инструменты</a><br>
                <a href="#">Штукатурно-малярный инструмент</a><br>
                <a href="#">Ленты клеящие, малярные</a><br>
                <a href="#">Измерительный инструмент</a><br>
            </div>
            <div class="category">
                <a href="#" class="root-category">Категория</a><br>
                <a href="#">Подкатегория первая</a><br>
                <a href="#">Подкатегория вторая</a><br>
            </div>
            <div class="category">
                <a href="#" class="root-category">Категория</a><br>
                <a href="#">Подкатегория первая</a><br>
                <a href="#">Подкатегория вторая</a><br>
            </div>
            <div class="category">
                <a href="#" class="root-category">Категория</a><br>
                <a href="#">Подкатегория первая</a><br>
                <a href="#">Подкатегория вторая</a><br>
                <a href="#">Подкатегория третья</a><br>
                <a href="#">Подкатегория четвёртая</a><br>
            </div>
            <div class="category">
                <a href="#" class="root-category">Категория</a><br>
                <a href="#">Подкатегория первая</a><br>
                <a href="#">Подкатегория вторая</a><br>
                <a href="#">Подкатегория третья</a><br>
            </div>
        </div>
    </section>
    <section id="mp-catalog">
        <div class="items">
            @foreach($products as $product)
            <div class="card">
                <div class="card-image" style="background-image: url('{{$product->images[0]['image']}}');"></div>
                <div class="card-title">{{$product->name}}</div>
                <a href="#">Подробнее о товаре</a>
            </div>
            @endforeach
        </div>
    </section>
</body>
</html>