@extends('layouts.app')
@section('title') Edit Blog | @endsection

@section('content')
<div class="" style="padding: 30px;">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        {{-- <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Create User</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Create User
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
                                <h4 class="card-title">Edit Blog</h4>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" id="userForm" role="form" action="{{url('blog').'/'.$blog->blog_id}}" method="post" enctype="multipart/form-data" >
                                @method('PUT')
                                @csrf
                                    <div class="media mb-2 col-md-6 offset-3">
                                        <img src="@if($blog->image){{ $blog->image }} @else {{  URL::asset('/resources/assets/img/default.png')}} @endif" class="gambar old_profile_imageSub user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" id="item-img-output"  name="avatar" style="object-fit: cover;" height="90" width="90"/>
                                        <div class="media-body mt-50">
                                            <div class="d-flex mt-1 px-0">
                                                {{-- <label class="btn btn-primary mr-75 mb-0" for="change-picture"> --}}
                                                    <input type="hidden" name="main_image" value="" id="main_image" style="">
                                                    {{-- <span class="d-none d-sm-block">Change</span> --}}
                                                    <input type="file" accept="image/png, image/jpeg, image/jpg" class="item-img file form-control " name="file_photo" />
                                                {{-- </label> --}}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('main_image') ? ' has-error' : '' }}">
                                            <div class="vc_column-inner ">
                                                <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog  ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">
                                                            </div>
                                                            <div class="modal-body">
                                                                <div id="upload-demo" class="center-block"></div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-default" id="Flip">Flip</button>
                                                                {{-- <button class="btn btn-default" id="rotate" data-deg="-90">Rotate</button>--}}
                                                                <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 offset-3">
                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label  class="control-label" for="name">Blog Name <span class="colorRed"> *</span></label>
                                                <div class=" jointbox">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="@if(!empty(old('name'))) {{old('name') }} @else {{$blog->name}} @endif"/>
                                                    @if ($errors->has('name'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 offset-3">
                                        <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}" >
                                            <label  class="control-label" for="category_id">Blog Category <span class="colorRed"> *</span></label>
                                                <select class="form-control select2" name="category_id[]" id="category_id" multiple>
                                                  
                                                <option></option>

                                                @foreach($category as $row)
                                                    <option {{ (isset($blog->category_id) && in_array($row->category_id, $blog->category_id) ) ? 'selected' : "" }} value="{{$row->category_id}}">{{$row->name}}</option>
                                                @endforeach
                                                </select>
                                                @if ($errors->has('category_id'))
                                                <span class="help-block alert alert-danger">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="" style="border-top:0">
                                                <div class="box-footer">
                                                    <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                                                    <button type="submit" id="createBtn" class="btn btn-primary pull-right" style="margin-left: 20px;float:right;">Create</button>
                                                    <button type="button" class="btn btn-info pull-right"  id="cancelBtn" style="float:right;">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('css')
    <style>
        .card{
            margin: 0px 100px;
        }
    </style>
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
    $(document.body).on('click', "#createBtn", function(){
        if ($("#userForm").length){
            $("#userForm").validate({
            errorElement: 'span',
                    errorClass: 'text-red text-danger',
                    ignore: [],
                    rules: {
                      "name":{
                          required:true,
                          minlength: 2,
                          maxlength: 20
                      },
                      "category_id[]":{
                          required:true,
                      },
                  },
                  messages: {
                        "name":{
                            required:"Please enter blog name.",
                        },
                        "category_id[]":{
                            required:"Please Select category",
                        },
                    },
                    errorPlacement: function(error, element) {
                        if(element.is('select')){
                            error.appendTo(element.closest("div"));
                        }else{
                            error.insertAfter(element.closest(".form-control"));
                        }
                    },
            });
        }
    });

</script>

<script>
$(document).ajaxStart(function() { Pace.restart(); });
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

</script>

<script>

$(document).ready(function() {
    $("#category_id").select2({
        placeholder: "Select a Category",
        allowClear: true,
    });
});
$("#cancelBtn").click(function () {
    window.location.href = "{{url('blog')}}";
});

</script>

<script type="text/javascript">
    // Start upload preview image
    var FLIP = 2;
    var NORMAL = 1;
    var orientation = NORMAL;
    var $uploadCrop1, tempFilename, rawImg, imageId;
    var fileTypes = ['jpg', 'jpeg', 'png'];
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var file = input.files[0]; // Get your file here
            var fileExt = file.type.split('/')[1]; // Get the file extension
            if (fileTypes.indexOf(fileExt) !== -1) {
                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');
                    $('#cropImagePop').modal('show');
                    rawImg = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);

            }else{
                swal("Only JPEG, PNG, JPG file types are supported");
            }
        }
        else {
            swal("Sorry - something went wrong");
        }
    }

    $uploadCrop1 = $('#upload-demo').croppie({
        viewport: {
            width: 480,
            height: 270,
        // type: 'square'
        },
        enableOrientation: true,
        enforceBoundary: false,
        enableExif: true,
        enableResize:true,
    });
    $('#cropImagePop').on('shown.bs.modal', function(){
        // alert('Shown pop');
        $uploadCrop1.croppie('bind', {
            url: rawImg
            }).then(function(){
                // console.log('jQuery bind complete');
            });
    });
    $('#Flip').click(function() {
            orientation = orientation == NORMAL ? FLIP : NORMAL;
            $uploadCrop1.croppie('bind', {
            url: rawImg,
            orientation: orientation,
        });
    });
    $('#rotate').click(function() {
        $uploadCrop1.croppie('rotate', parseInt($(this).data('deg')));
    });

    $('.item-img').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
    $('#cancelCropBtn').data('id', imageId); readFile(this); });
    $('#cropImageBtn').on('click', function (ev) {
            $uploadCrop1.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            size: {width: 1280, height: 720}
        }).then(function (resp) {
            $('#item-img-output').attr('src', resp);
            $('#main_image').attr('value', resp);
            $('#cropImagePop').modal('hide');
        });
    });
    // End upload preview image
</script>
@endsection
