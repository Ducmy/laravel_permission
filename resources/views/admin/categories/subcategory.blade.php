<li>{{ $child_category->name }}</li>
@if ($child_category->categories)
    <ul>
        @foreach ($child_category->categories as $childCategory)
            @include('admin.categories.subcategory', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif