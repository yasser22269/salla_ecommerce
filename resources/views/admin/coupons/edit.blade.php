@extends('layouts.admin')
@section('title','coupon  Edit')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">


   <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/'. getFolder() .'/plugins/file-uploaders/dropzone.css')}}">


@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">coupon </h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">coupon </a>
            </li>
            <li class="breadcrumb-item active">coupon  Edit
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="card-content">
    <div class="card-body">

      <div class="tab-content px-1 pt-1">
        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true" aria-labelledby="base-tab11">
            <form class="form" method="POST" action="{{ route('coupon.update',$coupon->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">General coupon Info</h4>
                  <input type="hidden"  name="id" value="{{ $coupon->id }}">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> code
                            </label>
                            <input type="text" id="code"
                                   class="form-control"
                                   placeholder="code"
                                   value="{{ $coupon->code }}"
                                   name="code">
                            @error("code")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="Type"> Type</label>
                              <select id="Type"
                                      class="form-control"
                                      name="type">
                                  <option value="fixed_amount" {{ $coupon->type == "fixed_amount" ? 'selected' : '' }} >Fixed Amount</option>
                                  <option value="percentage"{{ $coupon->type == "percentage" ? 'selected' : '' }} >Percentage</option>
                                  <option value="free_shipping"{{ $coupon->type == "free_shipping" ? 'selected' : '' }} >Free Shipping</option>
                              </select>

                              @error("type")
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="discount"> value</label>
                              <input type="number" id="discount"
                                     class="form-control"
                                     placeholder="  "
                                     value="{{ $coupon->discount}}"
                                     name="discount">
                              @error("discount")
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="valid_from"> Date From
                              </label>
                              <input type="date" id="valid_from"
                                     class="form-control"
                                     value="{{ $coupon->valid_from}}"
                                     name="valid_from">
                              @error("valid_from")
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="valid_to"> Date To
                              </label>
                              <input type="date" id="valid_to"
                                     class="form-control"
                                     value="{{ $coupon->valid_to}}"
                                     name="valid_to">
                              @error("valid_to")
                              <span class="text-danger">{{$message}}</span>
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
      </div>

    </div>
  </div>


      {{-- <div class="card">
          <div class="container">
            </div>
         </div> --}}


         @endsection

@section('js')


@endsection
