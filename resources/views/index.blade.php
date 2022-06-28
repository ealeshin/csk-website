<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Центр Строительной Комплектации</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script defer src="js/app.js"></script>
</head>
<body>
    <header>
        <div class="column">
            <div class="column">logo</div>
            <div class="column">phone</div>
            <div class="column">search</div>
        </div>
        <div class="column">
            <div class="column">question</div>
            <div class="column">cart</div>
        </div>
    </header>
    <nav>
        <a href="#">О компании</a>
        <a href="#">Каталог ЦСК</a>
        <a href="#">Контакты</a>
        <a href="#">Наши партнёры</a>
    </nav>
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach($slides as $url)
                <div class="swiper-slide" style="background-image: url('{{$url}}')"></div>
            @endforeach
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <div class="categories">
        <div class="category">First</div>
        <div class="category">Second</div>
        <div class="category">Third</div>
        <div class="category">Fourth</div>
        <div class="category">Fifth</div>
        <div class="category">Sixth</div>
    </div>
</body>
</html>