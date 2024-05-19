@extends('layouts.admin')
@section('title','coupons Create')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">coupons</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">coupons</a>
            </li>
            <li class="breadcrumb-item active">coupons Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
          <form class="form" method="POST" action="{{ route('coupon.store') }}">
                @csrf
                <div class="form-body">
                  <h4 class="form-section">coupon Info</h4>

                  <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="Code"> Code
                        </label>
                        <input type="text" id="Code"
                               class="form-control"
                               placeholder="  "
                               value="{{ old('code') }}"
                               name="code">
                        @error("code")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="Type"> Type
                          </label>
                          <select id="Type"
                                  class="form-control"
                                  name="type">
                              <option value="fixed_amount">Fixed Amount</option>
                              <option value="percentage">Percentage</option>
                              <option value="free_shipping">Free Shipping</option>
                          </select>

                          @error("type")
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                      </div>
                  </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="discount"> value
                            </label>
                            <input type="number" id="discount"
                                   class="form-control"
                                   placeholder="  "
                                   value="{{ old('discount') }}"
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
                                     value="{{ old('valid_from') }}"
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
                                     value="{{ old('valid_to') }}"
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


         @endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
{{-- <script src="{{asset('/')}}app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script> --}}
<script>
    $(document).ready(function() {
        $(".select2").select2();
        });
</script>
@endsection
