<script src="{{ env('APP_URL') }}/public/js/underscore-min.js"></script>
<script type="text/javascript">
  function tambahdata(){
      $.ajax({
                    url: "{{config('app.url')}}/datalinmas/store",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res){
                      if(res.status == "suskses"){
                        Swal.fire(
                                    'Data Berhasil Ditambahkan',
                                    'success'
                                  )
                                  setTimeout(function () { document.location.reload(true); }, 1000);
                      }
                    }
                })
              }
              function deletedata(objectid){
          Swal.fire({
                title: 'Yakin Akan Menghapus?',
                text: "Data tidak bisa dipulihkan setelah di Hapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                      $.ajax({
                            url: "{{config('app.url')}}/datalinmas/delete/"+objectid,
                            type: "GET",
                            data: {objectid: objectid},
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                              success:function(res){
                                  Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                  )
                                  setTimeout(function () { document.location.reload(true); }, 1000);
                                }
                              })
                            }
              })
    }

  function getData(objectid){
    $("#modaledit").modal();
    $.ajax({
        url: "{{config('app.url')}}/datalinmas/getdata",
        type: "GET",
        data: {objectid: objectid},
        headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
        success:function(res){
         if(res.status == "success"){
           console.log('berhasil')
         }
        }
      })
  }
function editData(objectid){
  //  $('#modaledit').html('')
   $.ajax({
     url: "{{config('app.url')}}/datalinmas/getdata",
     type: "POST",
     data: {objectid : objectid},
     headers: {
       'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      success:function(res){
        if(res.status == "success"){
          let objectid = $('#objectid').val(res.data.objectid);
          let kabkota = $('#kabkota_edit').val(res.data.kabkota);
          let kecamatan = $('#kecamatan_edit').val(res.data.kecamatan);
          let keldes = $('#keldes_edit').val(res.data.keldes);
          let jeniskelamin = $('#jeniskelamin_edit').val(res.data.jeniskelamin);
          let jenissatlinmas = $('#jenissatlinmas_edit').val(res.data.jenissatlinmas);
          let smbad = $('#smbad_edit').val(res.data.smbad);
          let smban = $('#smban_edit').val(res.data.smban);
          let noskpelantikan = $('#noskpelantikan_edit').val(res.data.noskpelantikan);
          $('#modaledit').modal('show')
       }
     }
   });
 }

 var map = L.map('map',{editable:true,doubleClickZoom: false,
        layers: []}).setView([-0.98982,113.91587],4);


$('#modaltambah').on('show.bs.modal', function(){
  setTimeout(function() {
    map.invalidateSize();
  }, 500);
 });

 function updateDataAjax(){
          let objectid = $('#objectid').val();
          let kabkota = $('#kabkota_edit').val();
          let kecamatan = $('#kecamatan_edit').val();
          let keldes = $('#keldes_edit').val();
          let jeniskelamin = $('#jeniskelamin_edit').val();
          let jenissatlinmas = $('#jenissatlinmas_edit').val();
          let smbad = $('#smbad_edit').val();
          let smban = $('#smban_edit').val();
          let noskpelantikan = $('#noskpelantikan_edit').val();

          let data_post=[
              objectid,
              kabkota,
              kecamatan,
              keldes,
              jeniskelamin,
              jenissatlinmas,
              smbad,
              smban,
              noskpelantikan
          ]
          console.log(data_post);
  $.ajax({
      url: "{{config('app.url')}}/datalinmas/update",
      method: "POST",
      headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      data : {data_post},
      success: function(res){
        if(res.status == "success"){
          Swal.fire(
                'UPDATE',
                'Data Berhasil di Update',
                'success'
              )
              setTimeout(function () { document.location.reload(true); }, 1000);
        }
      }
        })
  }

  var data_wilayah = JSON.parse('{!!$wilayah!!}');

  function findWilayah(nama_key, value) {
      let context = {};
      context[`${nama_key}`] = value;
      return _.findWhere(data_wilayah, context);
  }

  let data_kelurahan = _.pluck(data_wilayah, 'kelurahan');



$("#kelurahan").autocomplete({
        // source: data_kelurahan,
        source: function(request, response) {
            // delegate back to autocomplete, but extract the last term
            response($.ui.autocomplete.filter(data_kelurahan, _extractLast(request.term)));
        },
        select: function(event, ui) {
            var terms = _split(this.value);
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push(ui.item.value);
            // add placeholder to get the comma-and-space at the end
            terms.push("");
            this.value = terms.join(", ");
            return false;
        },
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
    });
    $("#keydown").keydown(function(){
        $(this).trigger('autocompleteselect');
    })
    $("#kelurahan").on("autocompleteselect", function() {
        setTimeout(function() {
            let list_kelurahan = $("#kelurahan").val().split(', ');
            console.log(list_kelurahan);
            let list_kecamatan = [];
            let list_wilayah = [];
            let kode_kel = "";
            for (let i = 0; i < list_kelurahan.length - 1; i++) {
                let find_data = findWilayah('kelurahan', list_kelurahan[i]);
                console.log(find_data);
                if (find_data !== undefined) { 
                    $("#alertKelurahan").fadeOut();
                    // $("#kode_kelurahan").val(find_data.kode_kelurahan);

                    // HANDLER KELURAHAN
                    kode_kel += find_data.kode_kelurahan;
                    if(i < list_kelurahan.length - 2 ){
                        kode_kel += ", ";
                    }
                    $("#kode_kelurahan").val(kode_kel);

                    // HANDLER KECAMATAN
                    list_kecamatan.push({
                        nama: find_data.kecamatan,
                        kode: find_data.kodekec
                    });
                    console.log(list_kecamatan);
                    // HANDLER WILAYAH
                    list_wilayah.push({
                        nama: find_data.kabupaten,
                        kode: find_data.kodekab
                    })

                } else {
                    $("#alertKelurahan").text('Kelurahan tidak valid');
                    $("#alertKelurahan").fadeIn();
                }
            }
            list_kecamatan = _.uniq(list_kecamatan, function(el) {
                return el.nama;
            });
            // HANDLER KECAMATAN
            if (list_kecamatan.length > 1) {

                let _text = "";
                let _kode = "";
                for (let i = 0; i < list_kecamatan.length; i++) {
                    _text += list_kecamatan[i].nama;
                    _kode += list_kecamatan[i].kode;
                    if (i < list_kecamatan.length - 1) {
                        _text += ", ";
                        _kode += ", ";
                    }
                }
                $("#kecamatan").val(_text);
                $("#nama_kecamatan").val(_text);
                // $("#kode_kecamatan").val(_kode);

            } else {
                $("#kecamatan").val(list_kecamatan[0].nama);
                $("#nama_kecamatan").val(list_kecamatan[0].nama);
                // $("#kode_kecamatan").val(list_kecamatan[0].kode);
            }

            // HANDLER WILAYAH
            list_wilayah = _.uniq(list_wilayah, function(el) {
                return el.nama;
            });
            console.log(list_wilayah);
            if (list_wilayah.length > 1) {

                let _text = "";
                let _kode = "";
                for (let i = 0; i < list_wilayah.length; i++) {
                    _text += list_wilayah[i].nama;
                    _kode += list_wilayah[i].kode;

                    if (i < list_wilayah.length - 1) {
                        _text += ", ";
                        _kode += ", ";
                    }
                }
                $("#nama_kabupaten").val(_text);
                $("#kabkota").val(_text);
                // $("#kode_wilayah").val(_kode);

            } else {
                $("#nama_kabupaten").val(list_wilayah[0].nama);
                $("#kabkota").val(list_wilayah[0].nama);
                // $("#kode_wilayah").val(list_wilayah[0].kode);
            }
        }, 10);
      });

function _extractLast(term) {
        return _split(term).pop();
    }

function _split(val) {
        return val.split(/,\s*/);
    }
    

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset:-1
}).addTo(map);

var curLocation=[0,0];
if (curLocation[0]==0 && curLocation[1]==0) {
	curLocation =[-0.98982,113.91587];	
}

map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {
	draggable:'true'
});

marker.on('dragend', function(event) {
var position = marker.getLatLng();
marker.setLatLng(position,{
	draggable : 'true'
	}).bindPopup(position).update();
	$("#Latitude").val(position.lat);
	$("#Longitude").val(position.lng).keyup();
});

map.addLayer(marker);    

map.on("click", function(e){
      var lat = e.latlng.lat;
      var lng = e.latlng.lng;
      if(!marker){
        marker = L.marker(e.latlng).addTo(map);
      }else{
        marker.setLatLng(e.latlng);
      }
    $("#Latitude").val(lat);
    $("#Longitude").val(lng);
});

</script>