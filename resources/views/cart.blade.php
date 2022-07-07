@include('partials.header')
    <section id="mp-catalog">
        <div class="items">
            @foreach($items as $item)
            <div class="card">
                <div class="card-image" style="background-image: url('{{$item['product']->images[0]['image']}}');"></div>
                <div class="card-title">{{$item['product']->name}}</div>
                <div>Количество: {{$item['count']}}</div>
            </div>
            @endforeach
        </div>
    </section>
</body>
</html>