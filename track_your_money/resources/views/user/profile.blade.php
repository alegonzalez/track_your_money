@extends('layouts.app')
@section('body')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-5 align-self-center">
      <h4 class="page-title">Profile</h4>
    </div>

  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <div class="card">
        <div class="card-body">
          <center class="m-t-30"> <img src="uploads/{{ Auth::user()->image_profile }}" class="rounded-circle"  id="image_profile" />
            <div class="upload-btn">
              <br>
              <button class="btn buttonUpload">Upload a file</button>
              <form class="form-horizontal form-material" method="POST" action="/user/{{Auth::user()->id}}" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <input type="file" name="fileImageProfile" accept="image/*"  onchange="readURL(this);"  />
              </div>
            </center>
          </div>
          <div>
          </div>
        </div>
      </div>
      <!-- Column -->
      <!-- Column -->

      <div class="col-lg-8 col-xlg-9 col-md-7">

        <div class="card">
          <div class="card-body">
            @if(session('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            <div class="form-group">
              <label class="col-md-12">Full Name</label>
              <div class="col-md-12">
                <input type="text" value="{{Auth::user()->name}}" id="name" name="name" class="form-control form-control-line {{ $errors->has('name') ? ' is-invalid' : '' }}">
                @if ($errors->has('name'))
                <span  role="alert">
                  <strong class="errorMessage">{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="example-email" class="col-md-12">Email</label>
              <div class="col-md-12">
                <input type="email" value="{{Auth::user()->email}}"  class="form-control form-control-line{{ $errors->has('email') ? ' is-invalid' : '' }}"  name="email">
                @if ($errors->has('email'))
                <span  role="alert">
                  <strong class="errorMessage">{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Password</label>
              <div class="col-md-12">
                <input type="password" name="password" id="password"  class="form-control form-control-line {{ $errors->has('password') ? ' is-invalid' : '' }}">
                @if ($errors->has('password'))
                <span  role="alert">
                  <strong class="errorMessage"> {{ $errors->first('password') }}</strong>
                </span>
                @endif
                @if (session('error_message'))
                <span role="alert">
                  <strong class="errorMessage"> {{ session('error_message') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-12">Confirm Password</label>
              <div class="col-md-12">
                <input type="password"  id="password_confirmation" name="password_confirmation"  class="form-control form-control-line">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <button class="btn btn-success"><i class="fas fa-edit"></i> &nbsp;Update Profile</button>
              </div>
            </div>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('indexScript')
<script type="text/javascript" src="js/authentication.js"></script>
@endsection
