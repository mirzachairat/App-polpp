@extends('Layouts.layout')
@section('content')
<style>
     .ui-autocomplete {
        z-index: 9999 !important;
        max-height: 200px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            /* add padding to account for vertical scrollbar */
            padding-right: 20px;
    }
    .ui-front ul li{
        list-style-type: none;
        margin: 0;
        padding: 0;
        background-color: #fffff;
    }
    #map{
			display: block; 
			position: relative;
			height: 412px;
		}
</style>
<div class="container-fluid nav-hidden" id="content">

<div id="main" style="margin-left:0px;">

    <div class="container-fluid">
<br>      
    <div class="close-bread">
        <a href="#"><i class="icon-remove"></i></a>
    </div>
</div>
</div>

<div class="row-fluid">
<div class="span12">
<div class="box">
    <div class="box-title">
        <h3><i class="bi bi-list"></i> 
        Membantu Tibum & Tranmas                
        </h3>
    </div>
    <hr>
    <div class="box-content">

        
        <form action="" method="post" name="form1" class="form-horizontal form-bordered">

            @csrf
            <div align="right">
                <!-- <a class="btn btn-green" href="https://satpolpp.kemendagri.go.id/personil_linmas/tambih "><i class="icon-plus-sign"></i> Tambah Data</a> -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaltambah"><i class="bi bi-plus-lg"></i>
                    Tambah Data
                </button>
            </div>
            <div class="row">
                 <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInput">Name</label>
                        <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Masukan kata kunci">
                    </div>
                    <div class="col-auto">
                    <button type="submit" class="btn btn-secondary mb-2">Cari</button>
                    </div>
                 </div>   
            </div>
            
            <div class="table-responsive">
                <table width="100%" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                        <th>NO</th>
                                    <th>TGL.KEGIATAN</th>
                                    <th>NAMA KABUPATEN/KOTA</th>
                                    <th>KECAMATAN</th>
                                    <th>KELURAHAN/DESA</th>
                                    <th>JENIS GANGGUAN TIBUMTRANMAS*</th>
                                    <th>PERMASALAHAN</th>
                                    <th>LOKASI PERMASALAHAN</th>
                                    <th>PEMECAHAN MASALAH</th>
                                    <th>INSTANSI TERKAIT</th>
                                    <th>KETERANGAN</th>
                                    <th colspan="2">Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tbody>
                            <?php $i = 0?>
                            @foreach($featuresdata as $feature)
                            <?php $i++?>
                            <tr id="ids{{$feature->attributes->objectid}}">
                                    <td>{{$i}}</td>
                                    <td>{{$feature->attributes->tanggalkegiatan}}</td>
                                    <td>{{$feature->attributes->kabkota}}</td>
                                    <td>{{$feature->attributes->kecamatan}}</td>
                                    <td>{{$feature->attributes->keldes}}</td>
                                    <td>{{$feature->attributes->jenisgangguan}}</td>
                                    <td>{{$feature->attributes->permasalahan}}</td>
                                    <td></td>
                                    <td>{{$feature->attributes->pemecahanmasalah}}</td>
                                    <td>{{$feature->attributes->instansiterkait}}</td>
                                    <td>{{$feature->attributes->keterangan}}</td>
                                    <td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="editModal" onclick="editData('{{$feature->attributes->objectid}}')"><i class="fas fa-eye"></i></a>||
                                        <!-- <a class="btn btn-warning btn-sm" id="delete"><i class="far fa-trash-alt"></i></a> -->
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm" id="delete" onclick="deletedata('{{$feature->attributes->objectid}}')"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody> 
                    </tbody>
                </table>
            </div>

        </form>

         <!-- modal tambah -->
            <div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Membantu Tibum & Tranmas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ui-front">
                            <form name="sdform" action="{{config('app.url')}}/linmas_tibum/store" id="formdata" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 row">
                                <label for="kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kelurahan" id="kelurahan" value=""/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan" disable>
                                    <input type="hidden" class="form-control" id="kecamatan" name="kecamatan" value="">
                                    <span class="material-input"></span>
                                    <span class="material-input"></span>
                                    <sup class="text-danger pull-right mt-3">* Terisi otomatis</sup>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kabkota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_kabupaten" name="nama_kabupaten" disable>
                                    <input type="hidden" class="form-control" id="kabkota" name="kabkota" value="">
                                    <span class="material-input"></span>
                                    <span class="material-input"></span>
                                    <sup class="text-danger pull-right mt-3">* Terisi otomatis</sup>
                                </div>
                            </div>       
                            <div class="mb-3 row">
                                <label for="tanggalkegiatan" class="col-sm-2 col-form-label">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="tanggalkegiatan" name="tanggalkegiatan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jenisgangguan" class="col-sm-2 col-form-label">Jenis Gangguan</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jenisgangguan" name="jenisgangguan" aria-label=".form-select-lg example">
                                    <option selected>Silahkan Pilih Jenis Gangguan</option>
                                    <option value="berat">Berat</option>
                                    <option value="sedang">sedang</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="permasalahan" class="col-sm-2 col-form-label">Permasalahan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="permasalahan" name="permasalahan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="pemecahanmasalah" class="col-sm-2 col-form-label">Pemecahan Masalahan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="pemecahanmasalah" name="pemecahanmasalah">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="instansiterkait" class="col-sm-2 col-form-label">Instansi Terkait</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="instansiterkait" name="instansiterkait">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="keterangan" name="keterangan">
                                </div>
                            </div>
                            <div id="map"></div>  
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submitdata">Submit</button>
                            </div>
                            </form>
                        </div>    
                    </div>
                </div>
            </div>        
          <!-- end modal tambah   -->

           <!-- modal edit Data -->
           <div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Membantu Tibum & Tranmas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                        <form name="sdform" action="{{config('app.url')}}/linmas_tibum/update" method="post" id="formdata_edit" enctype="multipart/form-data">
                                @csrf
                            <div class="mb-3 row">
                                <label for="kabkota_edit" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kabkota_edit" name="kabkota_edit">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kecamatan_edit" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kecamatan_edit" name="kecamatan_edit">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keldes_edit" class="col-sm-2 col-form-label">Desa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="keldes_edit" name="keldes_edit" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tanggalkegiatan_edit" class="col-sm-2 col-form-label">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="tanggalkegiatan_edit" name="tanggalkegiatan_edit">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jenisgangguan_edit" class="col-sm-2 col-form-label">Jenis Gangguan</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jenisgangguan_edit" name="jenisgangguan_edit" aria-label=".form-select-lg example">
                                    <option selected>Silahkan Pilih Jenis Gangguan</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="permasalahan_edit" class="col-sm-2 col-form-label">Permasalahan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="permasalahan_edit" name="permasalahan_edit">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="pemecahanmasalah_edit" class="col-sm-2 col-form-label">Pemecahan Masalahan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="pemecahanmasalah_edit" name="pemecahanmasalah_edit">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="instansiterkait_edit" class="col-sm-2 col-form-label">Instansi Terkait</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="instansiterkait_edit" name="instansiterkait_edit">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keterangan_edit" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="keterangan_edit" name="keterangan_edit">
                                </div>
                            </div>
                              
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submitdata">Submit</button>
                            </div>
                        </form>
                       
                        </div>    
                    </div>
                </div>
            </div>        
            </div>
          <!-- end modal tambah   -->
</div>
</div>

    @section('inline_script')
    @include('Pages.Tibum.script')
    @endsection
@endsection
