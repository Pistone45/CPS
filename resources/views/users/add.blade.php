@extends('layouts.admin')
@section('title') {{'Add User'}} @endsection
@section('content')
<br><br>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('dashboard/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('dashboard/js/custom-editors.js') }}"></script>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">

            <br><br>


            <section>
                <div class="section__content section__content--p30">
                    <div class="container">
                        <div class="row">

                        <div class="col-md-12">

                            @if(session()->has('message'))
                            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                {{ session()->get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif

                                <div class="card">
                                    <div class="card-header">
                                        <i class="mr-2 fa fa-align-justify"></i>
                                        <strong class="card-title" v-if="headerText">Add User</strong>
                                    </div>
                                    <div class="card-body">

<div class="row">

<div class="col-md-6">
    
<div class="card border-dark mb-3">
  <div class="card-header" align="center"><h5 class="card-title">Register a user below</h5></div>

    <form action="{{ route('users.register') }}" method="POST">
        @csrf
  <div style="margin-top: 10px;" class="form-group col-md-12">
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Email Address" aria-describedby="emailHelp" required value="{{ old('email') }}">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  <div class="form-group col-md-12">
    <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" id="exampleInputEmail1" placeholder="First Name" aria-describedby="emailHelp" value="{{ old('first_name') }}">
    @error('first_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  <div class="form-group col-md-12">
    <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" id="exampleInputEmail1" placeholder="Last Name" aria-describedby="emailHelp" value="{{ old('last_name') }}">
    @error('last_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  <div class="form-group col-md-12">
    <input name="address" type="address" class="form-control @error('address') is-invalid @enderror" id="exampleInputEmail1" placeholder="Address" aria-describedby="emailHelp" value="{{ old('address') }}">
    @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

    <div style="margin-bottom: 10px;" class="col-auto">
      <label class="sr-only" for="inlineFormInputGroup">Phone Number</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">+</div>
        </div>
        <input type="text" name="phone" class="form-control form-control @error('phone') is-invalid @enderror" id="inlineFormInputGroup" placeholder="Phone Number e.g 26588" value="{{ old('phone') }}">
    @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
      </div>
      <small>Phone number must start with 265</small>
    </div>


  <div class="form-group col-md-12">
    @csrf
    <label for="exampleFormControlSelect1">Select Role</label>
    <select name="role_id" class="form-control" id="exampleFormControlSelect1" required>
    @foreach($roles as $role)
      <option value="{{ $role->id }}">{{ $role->name }}</option>
    @endforeach
    </select>
  </div>

  <div class="form-group col-md-12">
    @csrf
    <label for="exampleFormControlSelect1">Select Gender</label>
    <select name="gender_id" class="form-control" id="exampleFormControlSelect1" required>
    @foreach($genders as $gender)
      <option value="{{ $gender->id }}">{{ $gender->name }}</option>
    @endforeach
    </select>
  </div>

    <div class="col-md-12">
    <button type="submit" style="margin-top: 10px;" class="btn btn-success w-100">Add User <i class="fas fa-plus"></i></button>
    <br><br>
    </div>
    </form>
  </div>
</div>
</div>

<div class="col-md-6"></div>
</div>

                                    </div>
                                </div>



                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>

                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © {{ date('Y') }} Nation Publications. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>custom-editors.js
            <!-- END PAGE CONTAINER-->

<script>
    $("input[type='number']").inputSpinner()
    $(".buttons-only").inputSpinner({buttonsOnly: true})
</script>
@endsection
