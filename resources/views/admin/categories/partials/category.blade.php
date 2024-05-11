@foreach ($categories as $item)
    <option value="{{ $item['id'] }}" {{ $item['id']  == $category->parent_id ? 'selected':"" }}>{{$category_name}} -  {{ $item['name'] }}</option>
    @if (count($category['children']) > 0)
        @include('admin.categories.partials.category', [
                                                'categories' => $item['children'],
                                                'category_name' => $category_name . " - ".  $item['name']
                                                                ])
    @endif
@endforeach
