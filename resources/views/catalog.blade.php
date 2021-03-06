@include('partials.header')
    <section id="categories">
        <div class="catalog">
            <div class="sidebar">
                <div class="sidebar-link @if(!$current) sidebar-link-current @endif">
                    <a href="/catalog">Все товары</a>
                </div>
                @php
                    $categories = \App\Models\Category::getRootCategories();
                @endphp
                @foreach($categories as $category)
                    <div class="sidebar-link @if($current == $category->id) sidebar-link-current @endif">
                        <a href="/category/{{$category->id}}">{{$category->title}}</a>
                    </div>
                    @if($category->hasSubcategories())
                        @foreach ($category->getSubcategories() as $subcategory)
                            <div class="sidebar-link-subcategory @if($current == $subcategory->id) sidebar-link-current @endif">
                                <a href="/category/{{$subcategory->id}}">{{$subcategory->title}}</a>
                            </div>
                        @endforeach
                    @endif
                @endforeach
                
            </div>
            <div class="items">
                @foreach($products as $product)
                <div class="card">
                    <div class="card-image" style="background-image: url('{{$product->images[0]['image']}}');"></div>
                    <div class="card-title">{{$product->name}}</div>
                    <a class="card-more" href="/product/{{$product->id}}">Подробнее о товаре</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('partials.footer')