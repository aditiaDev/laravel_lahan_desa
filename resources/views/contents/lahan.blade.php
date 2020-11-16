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
    
    <section class="content" style="padding-top: 10px;">
      <!-- Default box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Data Lahan</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <form class="form-horizontal" method="post"  id="FORM_SAVE" enctype="multipart/form-data">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="form-group row">
                  <label class="col-sm-3">Provinsi</label>
                  <div class="col-sm-9">
                    <select name="provinsi" id="provinsi" class="form-control select2" required></select>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3">Kabupaten</label>
                  <div class="col-sm-9">
                    <select name="kabupaten" id="kabupaten" class="form-control" required></select>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3">Kecamatan</label>
                  <div class="col-sm-9">
                    <select name="kecamatan" id="kecamatan" class="form-control" required></select>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3">Desa</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="desa" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3">Latitude</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="lat" id="lat" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3">Longitude</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="lng" id="lng" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3">Luas</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="luas" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3">Tampak Depan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="tampak_depan" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3">Lebar Jalan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="lebar_jalan" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3">Jaringan Listrik</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="jaringan_listrik" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3">Zona Lahan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="zona_lahan" required>
                  </div>
                </div>
                <div class="form-group increment">
                  
                  <div class="row">
                    <div class="col-3"><label>Photo</label></div>
                    <div class="col-9">
                      <div class="input-group">
                        <input type="file" name="photo[]" class="form-control">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-primary btn-add"><i class="fas fa-plus-square"></i></button>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>

                <div class="clone invisible">
                  <div class="row">
                    <div class="col-3"></div>
                    <div class="col-9">
                      <div class="input-group mt-2">
                        <input type="file" name="photo[]" class="form-control">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-danger btn-remove"><i class="fas fa-minus-square"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              
              <div class="col-7">
                <div id="here-maps">
                  <input size="40" id="place" style="position:absolute;z-index: 100;" type="text" placeholder="Search a Place...">
                  <div style="height: 400px" id="mapContainer"></div>
                </div>
              </div>
            </div>
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <center>
              <button type="submit" id="save_data" class="btn btn-info"><i class="fas fa-save"></i> SAVE</button>
              <button type="button" id="reset" class="btn btn-default">CANCEL</button>
            </center>
          </div>
          <!-- /.card-footer -->
        </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Default box -->
      <div class="card card-primary">
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
<script src="{{ asset('js/here.js') }}"></script>
<script src="{{asset('template/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('template/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $(function () {
    // $(".select2").select2();

    var SITEURL = '{{URL::to('')}}';
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#provinsi").select2({
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

    $("#kabupaten").select2({
        // minimumInputLength: 2,
        ajax: {
            url: SITEURL+"/api/lahan/getkabupatendata",
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (params) {
              var queryParameters = {
                term: params.term,
                id_provinsi: $("#provinsi").val()
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

    $("#kecamatan").select2({
        // minimumInputLength: 2,
        ajax: {
            url: SITEURL+"/api/lahan/getkecamatandata",
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (params) {
              var queryParameters = {
                term: params.term,
                id_kabupaten: $("#kabupaten").val()
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

    // $('#tb_data').DataTable({

    //     ajax: {
    //       url: SITEURL+"/master/provinsi/getprovinsidata",
    //       type: 'GET',
    //     },
    //     columns: [
    //             {data: 'id', name: 'id', 'visible': true,searchable: false},
    //             {data: 'name', name: 'name', orderable: true,searchable: true},
    //             { data: "id", 
    //               "render" : function(data){
    //                 return '<a href="#" target="_blank"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button></a> '+
    //                         '<a href="#" target="_blank"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></a>'
    //               }
    //             },
    //           ],
    //     order: [[0, 'asc']]
    // });

    // $("#save_data").click(function(){
    //   let frmData = $("#FORM_SAVE").serialize();
    //   $.ajax({
    //     url: SITEURL+"/api/lahan/savelahan",
    //     dataType: 'JSON',
    //     type: 'POST',
    //     data: frmData,
    //     success: function(data){
    //       console.log(data)
    //       alert(data.message);
    //     },
    //     error: function (err) {
    //       if (err.status == 422) { // when status code is 422, it's a validation issue
    //           console.log(err.responseJSON);
    //           alert(err.responseJSON.message);

    //           // you can loop through the errors object and show it to the user
    //           console.warn(err.responseJSON.errors);
    //           // display errors on each form field
    //           $.each(err.responseJSON.errors, function (i, error) {
    //               var el = $(document).find('[name="'+i+'"]');
    //               el.after($('<span style="color: red;">'+error[0]+'</span>'));
    //           });
    //       }
    //     }
    //   })
    // })


    $("#FORM_SAVE").on('submit', function(event){
      event.preventDefault();
      let frmData = new FormData(this);
      $.ajax({
        url: SITEURL+"/api/lahan/savelahan",
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
          console.log(data)
          // alert(data.message);
          if(data.status == 'error'){
            alert(data.message);
          }else{
            alert(data.message);
            location.reload();
          }
        },
        error: function (err) {
          if (err.status == 422) { // when status code is 422, it's a validation issue
              console.log(err.responseJSON);
              alert(err.responseJSON.message);

              // you can loop through the errors object and show it to the user
              console.warn(err.responseJSON.errors);
              // display errors on each form field
              $.each(err.responseJSON.errors, function (i, error) {
                  var el = $(document).find('[name="'+i+'"]');
                  el.after($('<span style="color: red;">'+error[0]+'</span>'));
              });
          }
        }
      })
      // alert('sdf')
    })

  });
</script>
<script>
  window.action = "submit"
  jQuery(document).ready(function () {
      jQuery(".btn-add").click(function () {
          let markup = jQuery(".invisible").html();
          jQuery(".increment").append(markup);
      });
      jQuery("body").on("click", ".btn-remove", function () {
          jQuery(this).parents(".input-group").remove();
      })
  })

var service = platform.getSearchService();


$("#place").autocomplete({
  source: placeAC,
  minLength: 3,
  select: function (event, ui) {
      console.log("Selected: " + ui.item.value + " with LocationId " + ui.item.id);
      document.getElementById('lat').value=ui.item.lat;
      document.getElementById('lng').value=ui.item.lng;

      map.setCenter({lat:ui.item.lat, lng:ui.item.lng});
      map.setZoom(14);
      marker.setGeometry( {lat:ui.item.lat, lng:ui.item.lng} );

  }
});

function placeAC(query, callback) {

  service.geocode({
      q: query.term
  }, (result) => {


  let places = result.items.map(items => {

      return {
              title: items.title,
              value: items.title,
              id: items.id,
              lat: items.position.lat,
              lng: items.position.lng
      };
  });

  return callback(places);
  }, alert)
}
</script>
<script>

</script>
@endpush