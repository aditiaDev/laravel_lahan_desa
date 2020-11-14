@extends('master')
@push('link')
<link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush
@section('content')
   
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"><a href="#">Home</a></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Provinsi</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
              <div class="col-md-12">
                <table id="tb_data" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
 
                    </tbody>
                </table>
              </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

@endsection

@push('script')
<script src="{{asset('template/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
  $(function () {
    // $("#example1").DataTable();

    var SITEURL = '{{URL::to('')}}';
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#tb_data').DataTable({

        ajax: {
          url: SITEURL+"/master/provinsi/getprovinsidata",
          type: 'GET',
          // data:{
          //   _token: $('meta[name="csrf-token"]').attr('content')
          // }
        },
        columns: [
                {data: 'id', name: 'id', 'visible': true,searchable: false},
                {data: 'name', name: 'name', orderable: true,searchable: true},
                { data: "id", 
                  "render" : function(data){
                    return '<a href="#" target="_blank"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button></a> '+
                            '<a href="#" target="_blank"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></a>'
                  }
                },
              ],
        order: [[0, 'asc']]
    });

  });
</script>
@endpush