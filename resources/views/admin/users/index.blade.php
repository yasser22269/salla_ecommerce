@extends('layouts.admin')
@section('title','users index')
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
            <li class="breadcrumb-item active">users index
            </li>
          </ol>
        </div>
      </div>
    </div>
    {{--  <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" >
        <a href="{{ route('user.create') }}">
            <button class="btn btn-info round  box-shadow-2 px-2"type="button" > Add user</button>
        </a>

      </div>
    </div>  --}}
  </div>

<div class="row" id="header-styling">
    <div class="col-12">
      <div class="card">

        <div class="card-content collapse show">
            <table class="table yajra-datatable mt-2" id="Users">
                <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th>Role</th>
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

            var table = $('#Users').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering : true,
                ajax: "{{ route("Users.GetUsers") }}",
                columns: [
                    // {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
                dom: 'Bfrtip'
            });

        });
    </script>
@endsection
