<section id="categories">
    <div class="items">
        @php
            $categories = \App\Models\Category::getRootCategories();
        @endphp
        @foreach($categories as $category)
        <div class="category">
            <a href="/category/{{$category->id}}" class="root-category">{{$category->title}}</a><br>
            @if($category->hasSubcategories())
                @foreach ($category->getSubcategories() as $subcategory)
                <a href="/category/{{$subcategory->id}}">{{$subcategory->title}}</a><br>
                @endforeach
            @endif
        </div>
        @endforeach
    </div>
</section>