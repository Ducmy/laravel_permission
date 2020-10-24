<li class="list-group-item">{{ $child_category->name }}<span class="float-right"><a href="{{route('edit_cat', ['cat_id'=> $child_category->id])}}" class="ml-auto btn btn-primary">Sửa</a><a href="{{route('destroy_cat', ['cat_id'=> $child_category->id])}}" class="btn btn-danger ml-2">Xóa</a></span></li>
@if ($child_category->categories)
    <ul class="list-group ml-5">
        @foreach ($child_category->categories as $childCategory)
            @include('admin.categories.subcategory', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif