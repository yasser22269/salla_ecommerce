@extends('layouts.admin')
@section('title','Setting index')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">Setting index
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
        <div class="btn-group float-md-right" >
                <button type="button" class="btn btn-info box-shadow-2 px-2" data-toggle="modal" data-target="#AddSetting">
                    Add Setting
                </button>
                <!-- Modal -->
                <div class="modal fade text-left" id="AddSetting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myModalLabel35">Add Setting</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form class="form" method="POST" action="{{ route('Settings.store') }}">
                            @csrf
                            <div class="modal-body">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="Key">Key</label>
                                    <input type="text" class="form-control" id="Key" name="key" placeholder="Key">
                                </fieldset>
                                <br>
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="Value">Value</label>
                                    <textarea class="form-control" id="Value" rows="3" name="value" placeholder="Value"></textarea>
                                </fieldset>
                            </div>
                            <div class="modal-footer">
                                <input type="reset" class="btn btn-danger btn-lg" data-dismiss="modal" value="close">
                                <input type="submit" class="btn btn-success btn-lg" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


<div class="row" id="header-styling">
    <div class="col-12">
        <div class="card">

            <div class="card-content collapse show">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-success white">
                        <tr>
                            <th> id</th>
                            <th>Key</th>
                            <th>Value</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($settings as $index => $setting)


                            <tr>
                                <td>{{ ($index++)+1 }}</td>
                                <td>{{ $setting->key  }}</td>
                                <td>{{ $setting->value  }} </td>
                                <td>
{{--                                    {{ route('coupon.edit',$coupon->id) }}--}}
                                        <button class="btn btn-info btn-sm round  box-shadow-2 px-1"type="button"data-toggle="modal" data-target="#EditSetting">
                                            <i class="la la-edit la-sm"></i> Edit </button>
                                    <!-- Modal -->
                                    <div class="modal fade text-left" id="EditSetting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="myModalLabel35">Edit Setting</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form class="form" method="POST" action="{{ route('Settings.update',$setting->id) }}">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <fieldset class="form-group floating-label-form-group">
                                                            <label for="Key">Key</label>
                                                            <input type="text" class="form-control" id="Key" value="{{$setting->key}}" name="key" placeholder="Key">
                                                        </fieldset>
                                                        <br>
                                                        <fieldset class="form-group floating-label-form-group">
                                                            <label for="Value">Value</label>
                                                            <textarea class="form-control" id="Value" rows="3" name="value" placeholder="Value">{{$setting->value}}</textarea>
                                                        </fieldset>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="reset" class="btn btn-danger btn-lg" data-dismiss="modal" value="close">
                                                        <input type="submit" class="btn btn-success btn-lg" value="Update">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                <td>

                                    <form class="form" method="POST" action="{{ route('Settings.destroy',$setting->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        {{--  coupons  --}}
                                        <button class="btn btn-danger btn-sm  round  box-shadow-2 px-1"type="submit" ><i class="la la-remove la-sm"></i> DELETE </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>


 @endsection






