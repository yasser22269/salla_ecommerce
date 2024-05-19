@extends('layouts.admin')
@section('title','products  Edit')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">


   <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/'. getFolder() .'/plugins/file-uploaders/dropzone.css')}}">


@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">products </h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Products.index') }}">products </a>
            </li>
            <li class="breadcrumb-item active">products  Edit
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="card-content">
    <div class="card-body">
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true" aria-labelledby="base-tab11">
            <form class="form" method="POST" action="{{ route('Products.update',$Product->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">General Product Info</h4>
                  <input type="hidden"  name="id" value="{{ $Product->id }}">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="Slug">Slug</label>
                        <input type="text" id="Slug" class="form-control" placeholder="slug" name="slug" value="{{ $Product->slug }}">
                        @error('slug')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="Name">Name:</label>
                          <input type="text" id="Name" class="form-control" placeholder="Name" name="name" value="{{  $Product->name }}">
                        </div>
                          @error("name")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="description">description:</label>
                          <textarea  name="description" id="description"
                            class="form-control"
                            placeholder=" description"
                                >{{  $Product->description }}</textarea>
                        </div>
                          @error("description")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price"> Price
                            </label>
                            <input type="number" id="price"
                                   class="form-control"
                                   placeholder="price"
                                   value="{{ $Product->price }}"
                                   name="price">
                            @error("price")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="quantity_available"> Quantity Available (optional)
                              </label>
                              <input type="number" id="quantity_available"
                                     class="form-control"
                                     placeholder="  "
                                     value="{{ $Product->quantity_available }}"
                                     name="quantity_available">
                              @error("quantity_available")
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                      </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> اختر القسم
                            </label>
                            <select name="category_id" class="form-control" >
                                <optgroup label="من فضلك أختر القسم ">

                                    @if($categories && $categories -> count() > 0)
                                        @foreach($categories as $category)
                                            <option
                                            {{ ($category->id == $Product->category_id) ? "selected" : ''}}
                                                value="{{$category->id }}">{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('category_id')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>
{{--                    <div class="col-md-4">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="projectinput1"> اختر ألعلامات الدلالية--}}
{{--                            </label>--}}
{{--                            <select name="tags[]" class="select2 form-control" multiple>--}}
{{--                                <optgroup label=" اختر ألعلامات الدلالية ">--}}

{{--                                    @if($tags && $tags -> count() > 0)--}}
{{--                                        @foreach($tags as $tag)--}}
{{--                                            <option--}}
{{--                                            @foreach($Product->tags as $Producttags)--}}
{{--                                            {{ ($tag->id == $Producttags->id) ? "selected" : ''}}--}}
{{--                                            @endforeach--}}

{{--                                                value="{{$tag->id }}">{{$tag->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </optgroup>--}}
{{--                            </select>--}}
{{--                            @error('tags')--}}
{{--                            <span class="text-danger"> {{$message}}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="projectinput1"> اختر ألماركة--}}
{{--                            </label>--}}
{{--                            <select name="brand_id" class="select2 form-control">--}}
{{--                                <optgroup label="من فضلك أختر الماركة ">--}}

{{--                                    @if($brands && $brands -> count() > 0)--}}
{{--                                        @foreach($brands as $brand)--}}
{{--                                            <option--}}
{{--                                            {{ ($brand->id == $Product->brand_id) ? "Selected" : ''}}--}}
{{--                                                value="{{$brand->id }}">{{$brand->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </optgroup>--}}
{{--                            </select>--}}
{{--                            @error('brand_id')--}}
{{--                            <span class="text-danger"> {{$message}}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                  <div class="row">
                    <div class="col-md-12">
                            <label for="switcheryColor4"
                                   class="card-title ">Status </label>
                            <input type="checkbox" value="1"
                                   name="status"
                                    {{ $Product ->status == 1 ? 'checked': ""}}
                                   id="switcheryColor4"
                                   class="switchery" data-color="success"
                                   />

                            @error("status")
                            <span class="text-danger">{{$message }}</span>
                            @enderror
                        </div>
                  </div>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Save
                      </button>
                    </div>
                </div>
              </form>
        </div>
      </div>
        <div class="tab-pane" id="tab12" aria-labelledby="base-tab12">
            <form class="form" method="POST" action="{{ route('Products.Priceupdate',$Product->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">Price Product Info</h4>
                  <input type="hidden"  name="product_id" value="{{ $Product->id }}">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> سعر  المنتج
                            </label>
                            <input type="number" id="price"
                                   class="form-control"
                                   placeholder="  "
                                   value="{{ $Product->price }}"
                                   name="price" disabled>
                            @error("price")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                 <hr>
                <h1 class="form-section"> عرض خاص</h1>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> سعر خاص
                            </label>
                            <input type="number"
                                   class="form-control"
                                   value="{{ $offer->special_price  ?? old('special_price') }}"
                                   name="special_price">
                            @error("special_price")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1">نوع السعر
                            </label>
                            <select name="special_price_type" class=" form-control" >
                                <optgroup label="من فضلك أختر النوع ">
                                    <option></option>
                                    <option value="percent" {{ $offer && $offer->special_price_type =="percent" ? "Selected" : '' }}>precent</option>
                                    <option value="fixed"  {{  $offer && $offer->special_price_type =="fixed" ? "Selected" : '' }}>fixed</option>
                                </optgroup>
                            </select>
                            @error('special_price_type')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>


                </div>


                <div class="row" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> تاريخ البداية
                            </label>

                            <input type="date"
                                   class="form-control"
                                   value="{{ $offer &&  $offer->special_price_start ?
                                   $offer->special_price_start :'' }}"
                                   name="special_price_start"
                                   >
                            @error('special_price_start')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> تاريخ البداية
                            </label>
                            <input type="date"
                                   class="form-control"
                                   value="{{$offer &&  $offer->special_price_end ?
                                    $offer->special_price_end : '' }}"
                                   name="special_price_end">

                            @error('special_price_end')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                  </button>
                </div>
                </div>
            </form>
          </div>
        <div class="tab-pane" id="tab13" aria-labelledby="base-tab13">
            <form
            action="{{route('Products.imageupdate.db',$Product->id)}}"
            method="POST" enctype="multipart/form-data" >
          @csrf
          <input type="hidden" name="product_id" value="{{$Product->id}}">
                        <h4 class="form-section"><i class="ft-image"></i> اداره الصور   </h4>
                            <div class="form-body">
                                <div class="form-group form">
                                    <label for="filename">Add Photos</label>
                                    <input id="filename" type="file"  class="form-control" name="filename[]" multiple>
                                </div>
                            </div>

                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> تحديث
                        </button>
                    </div>
        </form>
            <div class="row">
            @foreach ($Product->images as  $image)
            <div class="col-md-3" style="margin-bottom: 20px">

            <form action="{{route('admin.products.imagedeleteId',$image->id)}}"
            method="POST" enctype="multipart/form-data" >
              @csrf
                 <input type="hidden" name="id" value="{{$image->id}}">
                    <img src="{{ asset($image->path . "/" . $image->filename) }}" alt="{{$image->caption}}" height="100px" width="150px" style="border-style: dashed;" >
                    <input type="hidden" name="filename" value="{{ $image->filename }}">

                <button type="submit" class="btn btn-danger" style="width: 150px; ">
                   حذف
                </button>
            </form>
           </div>
            @endforeach

        </div>
        </div>

{{--        <div class="tab-pane" id="tab14" aria-labelledby="base-tab14">--}}
{{--            <form class="form"--}}
{{--            action="{{route('Products.stockupdate',$Product->id)}}"--}}
{{--            method="POST" >--}}
{{--          @csrf--}}
{{--                    <input type="hidden" name="id" value="{{$Product->id}}">--}}
{{--                        <h4 class="form-section"><i class="ft-home"></i> اداره المستودع   </h4>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="projectinput1"> كود  المنتج--}}
{{--                                    </label>--}}
{{--                                    <input type="text" id="sku"--}}
{{--                                            class="form-control"--}}
{{--                                            placeholder="  "--}}
{{--                                            value="{{$ManageStock->sku}}"--}}
{{--                                            name="sku">--}}
{{--                                    @error("sku")--}}
{{--                                    <span class="text-danger">{{$message}}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="projectinput1">حالة المنتج--}}
{{--                                    </label>--}}
{{--                                    <select name="in_stock" class="form-control" >--}}

{{--                                            <option {{($ManageStock->in_stock) ==0 ? "Selected " :'' }}value="0">غير متاح </option>--}}
{{--                                            <option {{($ManageStock->in_stock) ==1 ? "Selected " :'' }}value="1">متاح</option>--}}


{{--                                    </select>--}}
{{--                                    @error('in_stock')--}}
{{--                                    <span class="text-danger"> {{$message}}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <!-- QTY  -->--}}



{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="projectinput1">تتبع المستودع--}}
{{--                                    </label>--}}
{{--                                    <select name="manage_stock" class="form-control" id="manageStock">--}}
{{--                                            <option  {{($ManageStock->manage_stock) ==0 ? "Selected " :'' }}value="0" >عدم اتاحه التتبع</option>--}}
{{--                                            <option {{($ManageStock->manage_stock) ==1 ? "Selected " :'' }}value="1">اتاحة التتبع</option>--}}


{{--                                    </select>--}}
{{--                                    @error('manage_stock')--}}
{{--                                    <span class="text-danger"> {{$message}}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6" style="{{($ManageStock->manage_stock) ==0 ? 'display:none;' :'' }} "  id="qtyDiv">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="projectinput1">الكمية--}}
{{--                                    </label>--}}
{{--                                    <input type="text" id="sku"--}}
{{--                                            class="form-control"--}}
{{--                                            placeholder="  "--}}
{{--                                            value="{{$ManageStock->qty}}"--}}
{{--                                            name="qty">--}}
{{--                                    @error("qty")--}}
{{--                                    <span class="text-danger">{{$message}}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}



{{--                    <div class="form-actions">--}}

{{--                        <button type="submit" class="btn btn-primary">--}}
{{--                            <i class="la la-check-square-o"></i> تحديث--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--        </form>--}}
{{--        </div>--}}
      </div>
    </div>
  </div>


      {{-- <div class="card">
          <div class="container">
            </div>
         </div> --}}


         @endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="{{asset('/')}}app-assets/js/scripts/navs/navs.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $(".select2").select2();
        });
</script>
{{-- stock --}}
<script>
    $(document).on('change','#manageStock',function(){
       if($(this).val() == 1 ){
            $('#qtyDiv').show();
       }else{
           $('#qtyDiv').hide();
       }
    });
</script>

<script src="{{asset('/')}}app-assets/js/scripts/extensions/dropzone.js" type="text/javascript"></script>

@endsection
