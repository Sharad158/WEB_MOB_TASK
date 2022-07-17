@extends('layouts.authApp')

@section('content')
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
          <div class="auth-wrapper auth-v2">
              <div class="auth-inner row m-0">
                  <a class="brand-logo" href="javascript:void(0);">
                      {{-- <img src="{{ URL::asset('resources/uploads/logo/01.png')}}" alt="GirValley" height="50" width="130"> --}}
                       <h2 class="brand-text text-primary ml-1">{{ config('app.name', 'Laravel') }}</h2> 

                  </a>
                  <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{ URL::asset('/resources/assets/app-assets/images/pages/login-v2-dark.svg')}}" alt="Login V2" /></div>
                  </div>
                  <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                          <h2 class="card-title font-weight-bold mb-1">Welcome to {{ config('app.name', 'Laravel') }} 👋</h2>
                          <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
                          <form class="auth-login-form mt-2" id="dataForm" method="POST" action="{{ route('login') }}">
                          @csrf
                            @if (session('message'))
                              <div class="help-block alert alert-{{session('alert-class')}} text-left">
                                  <span>{{session('message')}}</span>
                              </div>
                            @endif
                              <div class="form-group">
                                <div class="d-flex justify-content-between">
                                  <label class="form-label" for="login-email">Email</label>
                                </div>
                                <div class="input-group input-group-merge">
                                  <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required aria-describedby="email" autofocus="" tabindex="1">
                                </div>
                                @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                                @endif
                              </div>
                              <div class="form-group">
                                  <div class="d-flex justify-content-between">
                                      <label for="login-password">Password</label><a href="{{route('password.request')}}"><small>Forgot Password?</small></a>
                                  </div>
                                  <div class="input-group input-group-merge form-password-toggle">
                                      <input id="password" type="password" class="form-control form-control-merge {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required aria-describedby="password" tabindex="2" >
                                      <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                  </div>
                                  @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <div class="custom-control custom-checkbox">
                                      <input id="remember" type="checkbox" name="remember" class="custom-control-input" {{ old("remember") ? "checked" : ""  }} tabindex="3">
                                      <label class="custom-control-label" for="remember"> Remember Me</label>
                                  </div>
                              </div>
                              <button type="submit" id="submitBtn" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
                          </form>
                          <p class="text-center mt-2">
                            <span>New on our platform?</span>
                            <a href="{{url('/register')}}">
                              <span>&nbsp;Create an account</span>
                            </a>
                          </p> 
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
@section('css')
@endsection
@section('script')
  @if(Session::has('message'))
    <script>
      $(function() {
          toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
      });
    </script>
  @endif

  <script>
    var SITE_URL = "<?php echo URL::to('/'); ?>";
    $.validator.addMethod("email", function(value, element) {
      return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
    }, "Please enter valid email address");

    $(document.body).on('click',"#submitBtn",function(){
        if($("#dataForm").length){
            $("#dataForm").validate({
                onfocusout: false,
                errorElement: 'div',
                errorClass: 'text-danger',
                ignore: [],
                    rules: {
                        "email":{
                            required:true,
                            email:true,
                        },
                        "password":{
                            required:true,
                        },
                    },
                    messages: {
                        "email":{
                            required:'Please enter email address.',
                        },
                        "password":{
                            required:"Please enter password.",
                        },
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element.closest(".input-group"));
                    },
                    submitHandler: function(form,e) {
                        e.preventDefault();
                        // $("#submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                        form.submit();
                    },
            });
        }
    });
  </script>
@endsection
