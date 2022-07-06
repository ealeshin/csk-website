<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Центр Строительной Комплектации</title>
    <link rel="stylesheet" href="/css/app.css?{{ time() }}">
    <link rel="stylesheet" href="/packages/line-awesome/css/line-awesome.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script defer src="/js/app.js?{{ time() }}"></script>
</head>
<body>
    <header>
        <div class="column">
            <div class="column logo-container">
                <a href="/" class="logo-link">
                    <img src="/images/logo.svg" alt="CSK Logo" class="logo">
                </a>
            </div>
            <div class="column nav">
                <div class="row search-container bp">
                    <input type="text" class="search-input" id="search" placeholder="Поиск">
                    <div class="search-results">
                        @php
                            $results = \App\Models\Product::getSearchResults();
                        @endphp
                        @foreach($results as $id => $name)
                            <div class="search-results-line" data-id="{{$id}}">{{$name}}</div>
                        @endforeach
                    </div>
                </div>
                <div class="row nav-links">
                    <div class="column">
                        <a href="/about" class="nav-link">О компании</a>
                    </div>
                    <div class="column">
                        <a href="/catalog" class="nav-link">Каталог ЦСК</a>
                    </div>
                    <div class="column">
                        <a href="/contacts" class="nav-link">Контакты</a>
                    </div>
                    <div class="column">
                        <a href="/partnerrs" class="nav-link">Наши партнёры</a>
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
                <div class="column nm ui-links">
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