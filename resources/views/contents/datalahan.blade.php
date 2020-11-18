@extends('master')
@push('link')
<link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/select2/css/select2.min.css')}}">

<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
<script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
@endpush
@section('content')
   
<div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content" style="padding-top: 10px;">

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
            <div class="col-3">
              <div class="form-group">
                <label>Provinsi</label>
                <select name="provinsi2" id="provinsi2" class="form-control"></select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Kabupaten</label>
                <select name="kabupaten2" id="kabupaten2" class="form-control"></select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Kecamatan</label>
                <select name="kecamatan2" id="kecamatan2" class="form-control"></select>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label>Status</label>
                <select name="status" id="status" class="form-control">
                  <option value="">ALL</option>
                  <option value="verified">VERIFIED</option>
                  <option value="under_verification">WAITING FOR VERIFICATION</option>
                </select>
              </div>
            </div>
            <div class="col-1">
                <button class="btn btn-sm btn-info" style="margin-top: 31px;">Show</button>
            </div>
          </div>
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
                      {{-- <th>Jaringan Listrik</th> --}}
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
                <label>Date</label>
                <input type="text" class="form-control" id="date" readonly>
              </div>
              <div class="form-group">
                <label>Lebar Jalan</label>
                <input type="text" class="form-control" id="lebar_jalan" readonly>
              </div>
              
              <div class="form-group">
                <label>Tim</label>
                <input type="text" class="form-control" id="tim" readonly>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                {{-- <input type="text" class="form-control" id="keterangan" readonly> --}}
                <textarea  id="keterangan"  rows="4" class="form-control" readonly></textarea>
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
                <label>Harga</label>
                <input type="text" class="form-control" id="harga" readonly>
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

    </section>
    <!-- /.content -->
</div>

@endsection

@push('script')
<script src="{{ asset('js/here.js') }}"></script>
<script src="{{asset('template/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('template/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $(function () {
    $("#status").select2();
    $("#test").hide(500);

    var SITEURL = '{{URL::to('')}}';
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#provinsi2").select2({
        // minimumInputLength: 2,
        ajax: {
            url: SITEURL+"/api/lahan/getprovinsidata",
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (params) {
              var queryParameters = {
                term: params.term
              }
              return queryParameters;
            },
            processResults: function (data) {
            
            return {
                results: $.map(data.items, function (item) {
                  // console.log(data)
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        }
        }
    });

    $("#kabupaten2").select2({
        // minimumInputLength: 2,
        ajax: {
            url: SITEURL+"/api/lahan/getkabupatendata",
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (params) {
              var queryParameters = {
                term: params.term,
                id_provinsi: $("#provinsi2").val()
              }
              return queryParameters;
            },
            processResults: function (data) {
            
            return {
                results: $.map(data.items, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        }
        }
    });
    
    $("#kecamatan2").select2({
        // minimumInputLength: 2,
        ajax: {
            url: SITEURL+"/api/lahan/getkecamatandata",
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (params) {
              var queryParameters = {
                term: params.term,
                id_kabupaten: $("#kabupaten2").val()
              }
              return queryParameters;
            },
            processResults: function (data) {
            
            return {
                results: $.map(data.items, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        }
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
                // {data: 'jaringan_listrik'},
                { data: null, 
                  "render" : function(data){
                    if(data.status == 'verified') {
                      return '<button type="button" onclick="show_detail('+data.id+')" class="btn btn-info btn-sm"><i class="fas fa-search-plus"></i></button> '+
                              ' <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>'
                    }else{
                      return '<button type="button" onclick="show_detail('+data.id+')" class="btn btn-info btn-sm"><i class="fas fa-search-plus"></i></button> '+
                              ' <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button> '+
                              ' <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-check"></i></button> '
                    }
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
        $("#keterangan").val(data[0].keterangan);
        $("#tim").val(data[0].tim);
        $("#position").val(data[0].lat+','+data[0].lng);
        $("#date").val(data[0].date);
        $("#harga").val(formatCurrency(data[0].harga,""));
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

  function formatCurrency(angka, prefix) {
      var number_string = angka.replace(/[^.\d]/g, '').toString(),
      split           = number_string.split('.'),
      sisa            = split[0].length % 3,
      rupiah          = split[0].substr(0, sisa),
      ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
    
      // tambahkan koma jika yang di input sudah menjadi angka ribuan
      if(ribuan){
          separator = sisa ? ',' : '';
          rupiah += separator + ribuan.join(',');
      }
    
      rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
  }
</script>
@endpush