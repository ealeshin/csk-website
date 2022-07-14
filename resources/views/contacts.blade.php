@include('partials.header')
    <section>
        <div class="product-container">
            <h1>Контакты</h1>
            <div class="product-layout">
                @isset($contacts->map)
                    <div class="map">
                        <iframe src="{{$contacts->map}}" frameborder="0"></iframe>
                    </div>
                @endisset
                <div class="contacts">
                    <div class="contacts-block">
                        @isset($contacts->office_type)<h2>{{$contacts->office_type}}</h2>@endisset
                        @isset($contacts->office_name)<p>{{$contacts->office_name}}</p>@endisset
                    </div>
                    <div class="contacts-block">
                        <p class="contacts-block-title">Адрес:</p>
                        @isset($contacts->address)<p>{{$contacts->address}}</p>@endisset
                    </div>
                    <div class="contacts-block">
                        <p class="contacts-block-title">Телефон:</p>
                        @isset($contacts->phone_main)<p>{{$contacts->phone_main}}</p>@endisset
                    </div>
                    <div class="contacts-block">
                        <p class="contacts-block-title">Режим работы:</p>
                        @isset($contacts->work_hours)<p>{{$contacts->work_hours}}</p>@endisset
                        @isset($contacts->days_off)<p>Выходные: {{$contacts->days_off}}</p>@endisset
                    </div>
                    <div class="contacts-block">
                        @isset($contacts->email)
                        <p class="contacts-block-title">E-mail:</p>
                        <p>
                            <a href="mailto:csk-opt@cskone.ru">{{$contacts->email}}</a>
                        </p>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('partials.footer')