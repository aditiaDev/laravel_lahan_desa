@extends('master')
@push('link')
<link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
<script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
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
          <h3 class="card-title">Data Lahan</h3>

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
                <table id="tb_data" style="font-size: 13px" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Provinsi</th>
                      <th>Kabupaten</th>
                      <th>Kecamatan</th>
                      <th>Desa</th>
                      <th>Luas</th>
                      <th>Tampak Depan</th>
                      <th>Lebar Jalan</th>
                      <th>Jaringan Listrik</th>
                      <th></th>
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

      <!-- Default box -->
      {{-- <div class="card collapsed-card" id="test"> --}}
        <div class="card" id="test">
        <div class="card-header">
          <h3 class="card-title">Detail Lahan</h3>

          <div class="card-tools">
            <button id="btn-toggle" type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus" id="fa_simbol"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Provinsi</label>
                <input type="text" class="form-control" id="provinsi" readonly>
              </div>
              <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" class="form-control" id="kecamatan" readonly>
              </div>
              <div class="form-group">
                <label>Luas</label>
                <input type="text" class="form-control" id="luas" readonly>
              </div>
              <div class="form-group">
                <label>Lebar Jalan</label>
                <input type="text" class="form-control" id="lebar_jalan" readonly>
              </div>
              <div class="form-group">
                <label>Zona Lahan</label>
                <input type="text" class="form-control" id="zona_lahan" readonly>
              </div>
              
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Kabupaten</label>
                <input type="text" class="form-control" id="kabupaten" readonly>
              </div>
              <div class="form-group">
                <label>Desa</label>
                <input type="text" class="form-control" id="desa" readonly>
              </div>
              <div class="form-group">
                <label>Tampak Depan</label>
                <input type="text" class="form-control" id="tampak_depan" readonly>
              </div>
              <div class="form-group">
                <label>Jaringan Listrik</label>
                <input type="text" class="form-control" id="jaringan_listrik" readonly>
              </div>
              <div class="form-group">
                <label>Position</label>
                <input type="text" class="form-control" id="position" readonly>
                <input type="hidden" class="form-control" id="lat" readonly>
                <input type="hidden" class="form-control" id="lng" readonly>
              </div>
            </div>
          </div>
          <div class="row" id="tampil_gambar">
          </div>
          <div class="row">
            <div class="col-12">
              <div id="here-maps">
                <div style="height: 400px" id="mapContainer"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      {{-- <div class="modal fade" id="modal_lahan">
        <div class="modal-dialog" style="max-width: 800px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detail Lahan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Provinsi</label>
                    <input type="text" class="form-control" id="provinsi" readonly>
                  </div>
                  <div class="form-group">
                    <label>Kecamatan</label>
                    <input type="text" class="form-control" id="kecamatan" readonly>
                  </div>
                  <div class="form-group">
                    <label>Luas</label>
                    <input type="text" class="form-control" id="luas" readonly>
                  </div>
                  <div class="form-group">
                    <label>Lebar Jalan</label>
                    <input type="text" class="form-control" id="lebar_jalan" readonly>
                  </div>
                  <div class="form-group">
                    <label>Zona Lahan</label>
                    <input type="text" class="form-control" id="zona_lahan" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Kabupaten</label>
                    <input type="text" class="form-control" id="kabupaten" readonly>
                  </div>
                  <div class="form-group">
                    <label>Desa</label>
                    <input type="text" class="form-control" id="desa" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tampak Depan</label>
                    <input type="text" class="form-control" id="tampak_depan" readonly>
                  </div>
                  <div class="form-group">
                    <label>Jaringan Listrik</label>
                    <input type="text" class="form-control" id="jaringan_listrik" readonly>
                  </div>
                  <div class="form-group">
                    <label>Position</label>
                    <input type="text" class="form-control" id="position" readonly>
                    <input type="hidden" class="form-control" id="lat" readonly>
                    <input type="hidden" class="form-control" id="lng" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div id="here-maps">
                    <div style="height: 400px" id="mapContainer"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> --}}

    </section>
    <!-- /.content -->
</div>

@endsection

@push('script')
<script src="{{ asset('js/here.js') }}"></script>
<script src="{{asset('template/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
  $(function () {
    // $("#example1").DataTable();
    $("#test").hide(500)

    var SITEURL = '{{URL::to('')}}';
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#tb_data').DataTable({

        ajax: {
          url: SITEURL+"/api/lahan/getlahandata",
          type: 'GET',
          // data:{
          //   _token: $('meta[name="csrf-token"]').attr('content')
          // }
        },
        columns: [
                {data: 'provinsi', name: 'provinsi', orderable: true, searchable: true},
                {data: 'kabupaten', name: 'kabupaten', orderable: true,searchable: true},
                {data: 'kecamatan'},
                {data: 'desa'},
                {data: 'luas'},
                {data: 'tampak_depan'},
                {data: 'lebar_jalan'},
                {data: 'jaringan_listrik'},
                { data: "id", 
                  "render" : function(data){
                    return '<button type="button" onclick="show_detail('+data+')" class="btn btn-info btn-sm"><i class="fas fa-search-plus"></i></button> '+
                            ' <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>'
                  }
                },
              ],
        order: [[0, 'asc']]
    });

  });

  function show_detail(id){
    $.ajax({
      url: "{{ route('getdetaillahandata') }}",
      type: 'GET',
      data: {
        id_lahan: id
      },
      success: function(data){
        let dapet = $.parseJSON(data);
        data = dapet['data'];
        // console.log(data)
        $("#provinsi").val(data[0].provinsi);
        $("#kabupaten").val(data[0].kabupaten);
        $("#kecamatan").val(data[0].kecamatan);
        $("#desa").val(data[0].desa);
        $("#luas").val(data[0].luas);
        $("#tampak_depan").val(data[0].tampak_depan);
        $("#lebar_jalan").val(data[0].lebar_jalan);
        $("#jaringan_listrik").val(data[0].jaringan_listrik);
        $("#zona_lahan").val(data[0].zona_lahan);
        $("#position").val(data[0].lat+','+data[0].lng);
        // $("#lat").val(data.lat);
        // $("#lng").val(data.lng);
        map.setCenter({lat:data[0].lat, lng:data[0].lng});
        map.setZoom(14);
        marker.setGeometry( {lat:data[0].lat, lng:data[0].lng} );

        $("#tampil_gambar").html('')
        $.each(data, function(index,array){
          console.log(array['photo'])
          $("#tampil_gambar").append('<div class="col-6"><div class="form-group"><img src="{{ URL::to('/') }}/images/'+array['photo']+'" alt="" style="width:100%"></div></div>')
        })
        
      }
    })

    $("#test").show(1000)
        $('html, body').animate({
            scrollTop: $("#test").offset().top
        }, 2000)

    // if($('#btn-toggle i').attr('class') == "fas fa-plus"){
    //   $("#btn-toggle").click()
    //   $('html, body').animate({
    //       scrollTop: $("#test").offset().top
    //   }, 2000)
    // }else{
    //   $("#btn-toggle").click()
    //   setTimeout(function(){
    //     $("#btn-toggle").click()
    //     $('html, body').animate({
    //         scrollTop: $("#test").offset().top
    //     }, 2000)
    //   },1000)

    // }
  }
</script>
@endpush