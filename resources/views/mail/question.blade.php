<html>
    <body>
        <p>Имя: {{$name}}</p>
        <p>E-mail: @if($email){{$email}}@else не указан @endif</p>
        <p>Телефон: @if($phone){{$phone}}@else не указан @endif</p>
        <hr>
        <p>Вопрос:</p>
        <p>{{$question}}</p>
    </body>
</html>