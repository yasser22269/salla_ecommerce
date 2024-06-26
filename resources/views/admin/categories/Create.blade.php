@extends('layouts.admin')
@section('title','categories Create')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">categories</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Category.index') }}">Categories</a>
            </li>
            <li class="breadcrumb-item active">categories Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
            <form class="form" method="POST" action="{{ route('Category.store') }}">
                @csrf
                <div class="form-body">
                  <h4 class="form-section">category Info</h4>


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">name</label>
                        <input type="text" id="projectinput1" class="form-control" placeholder="name" name="name">
                        @error('name')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      {{-- <div class="form-group">
                        <label for="projectinput2">Name</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Name" name="name">
                        @error('name')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div> --}}
                    </div>
                  </div>
                  <div class="row">


                  </div>
                  <div class="row">
                    <div class="col-md-12">
                            <label for="switcheryColor4"
                                   class="card-title ">Status </label>
                            <input type="checkbox" value="1"
                                   name="status"
                                   id="switcheryColor4"
                                   class="switchery" data-color="success"
                                   checked/>

                            @error("status")
                            <span class="text-danger">{{$message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-3">
                            <div class="form-group mt-1">
                                <input type="radio"
                                       name="type"
                                       value="1"
                                       class="switchery" data-color="success"
                                       checked
                                />

                                <label
                                    class="card-title ml-1">
                                    قسم رئيسى
                                </label>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mt-1">
                                <input type="radio"
                                       name="type"
                                       value="2"
                                       class="switchery" data-color="success"
                                />

                                <label
                                    class="card-title ml-1">
                                    قسم فرعي
                                </label>

                            </div>
                        </div>
                  </div>
                  <div class="row parent-id" style="display: none">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="projectinput5"> parent - Name</label>
                        <select  name="parent_id" class="form-control">
                          @if($categories  && $categories -> count() > 0)
                                <!-- index.blade.php -->
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}" >{{ $category['name'] }}</option>
                                        @if (count($category['children']) > 0)
                                         @include('admin.categories.partials.category', [
                                                'categories' => $category['children'],
                                                'category_name' => $category->name
                                                                ])
                                    @endif
                                @endforeach
                          @endif
                        </select>
                      </div>
                      @error('parent_id')
                      <span class="text-danger"> {{$message}}</span>
                      @enderror
                    </div>

                  </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                  </button>
                </div>
              </form>

          </div>
         </div>


         @endsection

@section('js')
    <script>
        $('input:radio[name="type"]').change(
            function(){
                if(this.checked &&this.value =='2')
                    $('.parent-id').show();
                else
                    $('.parent-id').hide();
            }
        )
    </script>

@endsection
