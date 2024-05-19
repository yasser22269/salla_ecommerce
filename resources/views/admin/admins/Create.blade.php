@extends('layouts.admin')
@section('title','Admin Create')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Admin</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('admin.Admins.index') }}">Admin</a>
            </li>
            <li class="breadcrumb-item active">Admin Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
            <form class="form" method="POST" action="{{ route('Admins.store') }}">
                @csrf
                <div class="form-body">
                  <h4 class="form-section">Admin Info</h4>
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
                       <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="email" name="email">
                        @error('email')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>

                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="password">password</label>
                              <input type="password" id="password" class="form-control" placeholder="password" name="password">
                              @error('password')
                              <span class="text-danger"> {{$message}}</span>
                              @enderror
                          </div>
                      </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input type="password" id="password_confirmation" class="form-control" placeholder="Password Confirmation" name="password_confirmation">
                                @error('password_confirmation')
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
         </div>


         @endsection

@section('js')

@endsection
