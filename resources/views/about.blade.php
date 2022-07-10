@include('partials.header')
<section class="cover" style="background-image: url('{{$content->image}}');">
</section>
<section>
    <div class="text-container">
        <h1>{{$content->title}}</h1>
        <p>{{$content->text}}</p>
    </div>
</section>
@include('partials.footer')