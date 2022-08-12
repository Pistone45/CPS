@extends('layouts.admin')

@section('title') {{'Users'}} @endsection

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        @error('image')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @enderror

          @if (session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

          @if(session()->has('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

          <br>

            <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#addUser">Add User <i class="fas fa-plus"></i></button>
            <br>
            <div class="card">
                <div class="card-header" align="center">
                    Users
                </div>
                <div class="card-body">

                <div id="" class="table table-bordered table-striped">
                                <table id="example1" class="table table-bordered table-striped example1">
                                  <thead>
                                    <tr>
                                      <th>Email</th>
                                      <th>First Name</th>
                                      <th>Last Name</th>
                                      <th>Date Added</th>
                                      <th>Role</th>
                                      <th>Action</th>
                                      <th>Action</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                                </table>
                              </div>


                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @csrf
                        <p style="color: red;">All fields are mandatory</p>
                        <div class="form-group row">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="First Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last name" autofocus placeholder="Last Name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                          <label for="inputEmail4">Select User Type</label>
                          <select name="role_id" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group row">
                          <label for="formFileSm" class="form-label">Select New Image</label>
                          <input name="image" class="form-control @error('image') is-invalid @enderror" id="image" type="file">
                        </div>

<!--                         <div class="form-group row">
                                <input id="password" type="hidden" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" value="sparc2021">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div> -->
<!-- 
                        <div class="form-group row">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Comfirm Password">
                        </div> -->

                        <div class="form-group row mb-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Add User <i class="fas fa-plus"></i>
                                </button>
                        </div>
                    </form>             
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


<script>
 var table = $(function () {
    $("#example1").DataTable({
        processing: true,
        order: [[ 3, "desc" ]],
        dom: 'lBfrtip',
        "responsive": false, "autoWidth": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
         buttons: [
                {
                    extend: 'pdf',
                    title: 'Users',
                    exportOptions: 
                    {
                    columns: [ 0, 1, 2, 3, 4 ]
                    }
                },
                {
                    extend: 'excel',
                    title: 'Users',
                    exportOptions: 
                    {
                    columns: [ 0, 1, 2, 3, 4 ]
                    }
                },
                {
                    extend: 'csv',
                    title: 'Users',
                    exportOptions: 
                    {
                    columns: [ 0, 1, 2, 3, 4 ]
                    }
                }

                ],
        serverSide: true,
        ajax: {
                url: '{{ route('users.home') }}',
            },
        columns: [
            {data: 'email', name: 'email'},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {
                data: "created_at",
                "render": function (value) {
                    if (value === null) return "";
                    return moment(value).format('DD/MM/YYYY');
                }
            },
            {data: 'role.name', name: 'role.name'},
            {
            "render": function (data, type, full, meta) {
                return "<a href='users/reset-password/" + full.id + "' class='btn btn-secondary'><i class='fas fa-unlock-alt'></i></a>";
            }
            }
            ,
            {
            "render": function (data, type, full, meta) {
                return "<a href='users/edit/" + full.id + "' class='btn btn-success'><i class='fas fa-edit'></i></a>";
            }
            }
            ,
            {
            "render": function (data, type, full, meta) {
                return "<a href='users/delete/" + full.id + "' class='btn btn-danger'><i class='fas fa-trash'></i></a>";
            }
            }
        ]
    });
  });
</script>

@endsection