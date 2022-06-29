<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Центр Строительной Комплектации</title>
    <link rel="stylesheet" href="css/app.css?{{ time() }}">
    <link rel="stylesheet" href="packages/line-awesome/css/line-awesome.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script defer src="js/app.js"></script>
</head>
<body>
    <header>
        <div class="column">
            <div class="column logo-container">
                <img src="images/logo.svg" alt="CSK Logo" class="logo">
            </div>
            <div class="column nav">
                <div class="row search-container bp">
                    <input type="text" class="search-input" placeholder="Поиск">
                </div>
                <div class="row">
                    <div class="column">
                        <a href="#" class="nav-link">О компании</a>
                    </div>
                    <div class="column">
                        <a href="#" class="nav-link">Каталог ЦСК</a>
                    </div>
                    <div class="column">
                        <a href="#" class="nav-link">Контакты</a>
                    </div>
                    <div class="column">
                        <a href="#" class="nav-link">Наши партнёры</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="column nav">
                <div class="column nm bp">
                    <div class="phone">
                        <i class="la la-phone icon"></i>
                        8 800 123-45-67
                    </div>
                </div>
                <div class="column nm">
                    <div class="column">
                        <i class="la la-question icon"></i>
                        Вопрос директору
                    </div>
                    <div class="column nm">
                        <i class="la la-shopping-cart icon"></i>
                        Корзина [0]
                    </div>
                </div>
            </div>    
        </div>
    </header>
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach($slides as $url)
                <div class="swiper-slide" style="background-image: url('{{$url}}')"></div>
            @endforeach
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
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
            <div class="card">23</div>
            <div class="card">3213</div>
            <div class="card">fdsf</div>
            <div class="card">fsdfd</div>
            <div class="card">vcxmdf</div>
            <div class="card">pkkdd</div>
        </div>
    </section>
</body>
</html>