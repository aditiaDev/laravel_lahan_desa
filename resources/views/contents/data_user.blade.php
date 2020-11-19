@extends('master')
@push('link')
<link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush
@section('content')
   
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content" style="padding-top: 10px;">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Users</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus"></i> Tambah Data</button>
          <div class="row">
              <div class="col-md-12">
                <table id="tb_data" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Level</th>
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
      <div class="modal fade" id="modal_tampil">
        <div class="modal-dialog" >
          <form id="FRM_SAVE">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                      <label>Level</label>
                      <select name="level" id="level" class="form-control">
                        <option value="user">USER</option>
                        <option value="admin">ADMIN</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
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
          url: "{{ route('getdatauser') }}",
          type: 'GET',
          // data:{
          //   _token: $('meta[name="csrf-token"]').attr('content')
          // }
        },
        columns: [
                {data: 'id', name: 'id', 'visible': true,searchable: false},
                {data: 'name', name: 'name', orderable: true,searchable: true},
                {data: 'username', name: 'username', orderable: true,searchable: true},
                {data: 'email', name: 'email', orderable: true,searchable: true},
                {data: 'level', name: 'level', orderable: true,searchable: true},
                { data: "id", 
                  "render" : function(data){
                    return '<!--<a href="#" target="_blank"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button></a>--> '+
                            '<a href="#" target="_blank"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></a>'
                  }
                },
              ],
        order: [[0, 'asc']]
    });

    $("#add_data").click(function(){
      $("#modal_tampil").modal('show')
    });

    $("#FRM_SAVE").submit(function(event){
      event.preventDefault();
      let frmData = new FormData(this);
      $.ajax({
        url: SITEURL+"/api/user/saveuser",
        type: "POST",
        data: frmData,
        beforeSend: function(){
          $("#LOADER").show();
        },
        complete: function(){
          $("#LOADER").hide();
        },
        processData : false,
        cache: false,
        contentType : false,
        success: function(data){
          // console.log(data)
          // alert(data.message);
          if(data.status == 'error'){
            alert(data.message);
          }else{
            alert(data.message);
            // location.reload();
          }
        },
        error: function (err) {
          // if (err.status == 422) { // when status code is 422, it's a validation issue
          //     console.log(err.responseJSON);
              alert(err.responseJSON.message);

              // you can loop through the errors object and show it to the user
          //     console.warn(err.responseJSON.errors);
          //     // display errors on each form field
          //     $.each(err.responseJSON.errors, function (i, error) {
          //         var el = $(document).find('[name="'+i+'"]');
          //         el.after($('<span style="color: red;">'+error[0]+'</span>'));
          //     });
          // }
        }
      })
    })

    // function delete_lahan(id){
    //   if (confirm('Hapus Data ini?')) {
    //     $.ajax({
    //       url: "{{ route('delete_lahan') }}",
    //       type: 'POST',
    //       data: {
    //         id_lahan: id
    //       },
    //       success: function(data){
    //         // console.log(data)
    //         if(data.status == 'error'){
    //           alert(data.message);
    //         }else{
    //           alert(data.message);
    //           REFRESH_TABLE();
    //         }
    //       }
    //     })
    //   } 
      
    // }

  });
</script>
@endpush