@foreach ($categories as $category)
    <option value="{{ $category['id'] }}">{{$category_name}} -  {{ $category['name'] }}</option>
    @if (count($category['children']) > 0)
        {{$category_name = $category_name . " - ".  $category['name'] }}
        @include('admin.categories.partials.category', [
                                                'categories' => $category['children'],
                                                'category_name' => $category_name
                                                                ])
    @endif
@endforeach
