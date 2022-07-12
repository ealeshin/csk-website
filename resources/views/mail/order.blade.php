<html>
    <body>
        <p>Имя: {{$name}}</p>
        <p>E-mail: @if($email){{$email}}@else не указан @endif</p>
        <p>Телефон: @if($phone){{$phone}}@else не указан @endif</p>
        <hr>
        <p>Заказ</p>
        @foreach($data as $item)
        <p>{{$item}}</p>
        @endforeach
    </body>
</html>