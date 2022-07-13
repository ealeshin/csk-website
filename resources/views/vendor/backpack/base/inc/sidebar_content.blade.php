<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
    </a>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon la la-list"></i>Контент сайта
    </a>
    <ul class="nav-dropdown-items">
        <a class="nav-link" href="{{ backpack_url('slide') }}">
            <i class="la la-photo nav-icon"></i> Слайдер
        </a>
        <a class="nav-link" href="{{ backpack_url('partner') }}">
            <i class="la la-user nav-icon"></i> Партнёры
        </a>
        <a class="nav-link" href="{{ backpack_url('content') }}">
            <i class="la la-info nav-icon"></i> О компании
        </a>
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('product') }}">
        <i class="la la-shopping-cart nav-icon"></i> Товары
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('category') }}">
        <i class="la la-list nav-icon"></i> Категории
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('unit') }}">
        <i class="la la-calculator nav-icon"></i> Единицы измерения
    </a>
</li>