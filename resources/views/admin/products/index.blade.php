@extends('layouts.admin')
@section('title','products index')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">products create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">products index
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" >
        <a href="{{ route('Products.create') }}">
            <button class="btn btn-info round  box-shadow-2 px-2"type="button" > Add Product</button>
        </a>

      </div>
    </div>
  </div>

<div class="row" id="header-styling">
    <div class="col-12">
        <div class="card">

            <div class="card-content collapse show">
                <table class="table yajra-datatable mt-2" id="GetProducts">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Quantity Available</th>
                        <th>Viewed</th>
                        <th>Status</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready( function () {

            var table = $('#GetProducts').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering : true,
                ajax: "{{ route("Product.GetProducts") }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'category', name: 'category'},
                    {data: 'quantity_available', name: 'quantity_available'},
                    {data: 'viewed', name: 'viewed'},
                    {data: 'status', name: 'status'},
                    {
                        data: 'action',
                        name: 'action',
                    }
                ],
                dom: 'Bfrtip'
            });
        });
    </script>
@endsection
