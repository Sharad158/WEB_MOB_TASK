@section('title') Blog | @endsection
@extends('layouts.app')
@section('content')
<div class="" style="padding: 30px;">
  {{-- app-content content  --}}
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        {{-- <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Blog</h2>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="content-body">
            <section id="">
                <div class="row">
                   
                   <div class="clear-fix"></div>
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header border-bottom">
                          <h3 class="card-title"><strong>Blog</strong></h3>
                          <div class="col-sm-12 pull-right  " style="padding-bottom: 10px;">
                                    
                            <a href="{{route('blog.create')}}" class="float-right">
                              <button type="button" class="btn btn-primary waves-effect waves-float waves-light">New Blog</button>
                            </a>

                            <div class="row" style="float:right; padding-right:30px;">
                              <div class="col-md-6">
                                <input type="text" name="from_date" id="from_date" class="form-control flatpickr-basic date" placeholder="From Date" />
                              </div>
                              <div class="col-md-6">
                                <input type="text" name="to_date" id="to_date" class="form-control flatpickr-basic date" placeholder="To Date" />
                              </div>
                            </div>
                          </div>
                        </div>
                          <div class="card-datatable datatable-row-remove">
                              {!! $html->table(['class' => 'table  dt-complex-header table-bordered','id'=>'customers']) !!}
                          </div>
                      </div>
                  </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('script')
{!! $html->scripts() !!}
@if(Session::has('message'))
    <script>
    $(function() {
      toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
    });
    </script>
  @endif

<script>

  var SITE_URL = "<?php echo URL::to('/'); ?>";
// change user Status
  $(document.body).on('click', '.actStatus' ,function(event){
    var row = this.id;
    var dbid = $(this).attr('data-sid');
    bootbox.confirm({
      message: "Are you sure you want to change user status ?",
      buttons: {'cancel': { label: 'No',className: 'btn-danger'},
      'confirm': { label: 'Yes',className: 'btn-success'}
    },
    callback: function(result){
      if (result){
        $.ajax({
          type :'POST',
          data : {id:dbid, _token:'{{ csrf_token() }}'},
          url  : 'blog/status-change',
          success  : function(response) {
            if (response == 'Active') {
                $('#'+row+'').text('Active').removeClass('text-danger').addClass('text-green');
            }
            else if(response == 'Deactive') {
                $('#'+row+'').text('Deactive').removeClass('text-green').addClass('text-danger');
            }
            else if(response == 'error') {
              bootbox.alert('Something Went to Wrong');
            }
          }
         });
        }
      }
    });
  });

  function deleteConfirm(id){
  
    bootbox.confirm({
      message: "Are you sure you want to delete ?",
      buttons: {'cancel': {label: 'No',className: 'btn-danger'},
                'confirm': {label: 'Yes',className: 'btn-success'}
      },
      callback: function(result){
        if (result){
          $.ajax({
            url: SITE_URL + '/blog/'+id,
            type: "DELETE",
            cache: false,
            data:{ _token:'{{ csrf_token() }}'},
            success: function (data, textStatus, xhr) {
              if(data== true && textStatus=='success' && xhr.status=='200')
              {
                  toastr.warning('Blog Deleted !!');
                  $('#customers').DataTable().ajax.reload(null, false);
              }
              else {  toastr.error(data); }
            }
          });
        }
      }
    });
  }
</script>

<script>
  $('.date').on('change', function(){
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();

    if(to_date && from_date > to_date){
      swal("End date should be greater or equal start date !!!")
    }
    
    console.log(from_date,to_date);
    $('#customers').on('preXhr.dt', function ( e, settings, data ) {
      data.from_date = from_date;
      data.to_date = to_date;
    });
    window.LaravelDataTables["customers"].draw();
  });
  </script>
@endsection
