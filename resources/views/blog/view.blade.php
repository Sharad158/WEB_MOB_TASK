@extends('layouts.app')
@section('title')  Blog Details | @endsection
@section('css')
  <style>
    .card{
       margin:0px 50px;
    }
  </style>
@endsection
@section('content')
<div class="" style="padding: 30px;">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        {{-- <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">User Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">User Details
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="content-body">
            <section class="bs-validation">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Blog Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-user-information">
                                      <tbody>
                                        <tr>
                                            <td><strong>Blog Name</strong></td>
                                            <td class="text-primary">{{$blog->name}}</td>
                                        </tr>
                                        
                                       <tr>
                                            <td><strong>Blog Category</strong></td>
                                            <td class="text-primary">
                                                @foreach($category as $row)
                                                  {{$row->name}} ,
                                                @endforeach
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><strong>status</strong></td>
                                            <td class="text-white">
                                              
                                                @if($blog->status == '1')
                                                   <a class="badge badge-success">Success</a>
                                                @else
                                                <a class="badge badge-danger">DeActive</a>                                               
                                                @endif
                                              </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Profile Image</strong></td>
                                            <td class="text-primary">
                                              <figure>
                                                <img src="@if(isset($blog))@if($blog->getOriginal('image')){{$blog->image}} @endif @else {{ URL::asset('/resources/assets/img/user.png')}} @endif " class="gambar old_profile_imageSub" id="item-img-output" name="avatar" width="300px"/>
                                              </figure>
                                            </td>
                                          </tr>
                                      </tbody>
                                    </table>
                                    <div class="col-sm-12">
                                        <div class="" style="border-top:0">
                                            <div class="box-footer">
                                                <a type="" href="{{url('/blog')}}" id="cancelBtn" class="btn btn-primary pull-right">
                                                  Back
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
