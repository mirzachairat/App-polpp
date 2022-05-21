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
        <h3>
            <i class="bi bi-list"></i>
            Peristiwa Bencana/Lainnya                </h3>
    </div>
    <hr>
    <div class="box-content">

        
        <form action="" method="post" name="form1" class="form-horizontal form-bordered">

            @csrf
            <div align="right">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaltambah"><i class="bi bi-plus-lg"></i>
                    Tambah Data
                </button>
            </div>
            
           
            <!-- <div class="control-group">
                <label class="control-label" for="textfield">Pencarian</label>
                <div class="controls">
                    <input type="text" value="" class="form-control" name="cari_personil_linmas" placeholder="Masukan kata kunci... (Nama)">
                    <input type="submit" name="submit" value="Cari" class="btn btn-blue btn-sm">
                    <a class="btn btn-red" href="https://satpolpp.kemendagri.go.id/personil_linmas/clear_session"><i class="icon-trash"></i> Hapus Pencarian</a>
                </div>
            </div> -->
            <br>
            
            
            <div class="table-responsive">
                <table width="100%" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                        <tr>
                            <th>NO</th>
                            <th>TGL.KEGIATAN</th>
                            <th>WAKTU KEGIATAN</th>
                            <th>DESA/KOTA</th>
                            <th>JENIS BENCANA</th>
                            <th>SIFAT BENCANA</th>
                            <th>JUMLAH KORBAN MANUSIA</th>
                            <th>JUMLAH KORBAN MATERIIL</th>
                            <th>JENIS PERTOLONGAN</th>
                            <th>FOTO</th>
                            <th width="5%">AKSI</th>
                            </tr>
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
                                    <td></td>
                                    <td>{{$feature->attributes->kabkota}}</td>
                                    <td>{{$feature->attributes->jenisbencana}}</td>
                                    <td>{{$feature->attributes->sifatbencana}}</td>
                                    <td></td>
                                    <td>{{$feature->attributes->korbanmanusia}}</td>
                                    <td>{{$feature->attributes->korbanmateriil}}</td>
                                    <td>{{$feature->attributes->jenispertolongan}}</td>
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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Peristiwa Bencana/Lainnya</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ui-front">
                            <form name="sdform" action="{{config('app.url')}}/bencana_kebakaran/store" id="formdata" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="mb-3 row">
                                <label for="tanggalkegiatan" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="tanggalkegiatan" name="tanggalkegiatan" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="waktu" class="col-sm-2 col-form-label">Waktu</label>
                                <div class="col-sm-4">   
                                <select class="form-select form-select-sm mb-3" id="waktu" name="waktu" aria-label=".form-select-lg example">
                                    <option selected>--Pilih--</option>
                                    <option value="Pagi">Pagi</option>
                                    <option value="Siang">Siang</option>
                                    <option value="Sore">Sore</option>
                                </select>
                            </div>    
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
                                <label for="jenisbencana" class="col-sm-2 col-form-label">Jenis Bencana</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jenisbencana" name="jenisbencana" aria-label=".form-select-lg example">
                                    <option selected>Pilih Jenis Bencana</option>
                                    <option Value="Banjir">Banjir</option>
                                    <option Value="Gempa Bumi">Gempa Bumi</option>
                                    <option Value="Kebakaran">Kebakaran</option>
                                    <option Value="Tsunami">Tsunami/option>
                                    <option Value="Gunung Meletus">Gunung Meletus</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="sifatbencana" class="col-sm-2 col-form-label">Sifat Bencana</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="sifatbencana" name="sifatbencana" aria-label=".form-select-lg example">
                                <option selected>--Pilih Sifat Bencana--</option>
                                    <option value="Lokal">Lokal</option>
                                    <option value="Nasional">Nasional</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="korbanmanusia" class="col-sm-2 col-form-label">Korban Manusia</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="korbanmanusia" name="korbanmanusia" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="korbanmateriil" class="col-sm-2 col-form-label">Korban Materiil</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="korbanmateriil" name="korbanmateriil" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jenispertolongan" class="col-sm-2 col-form-label">Jenis Pertolongan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jenispertolongan" name="jenispertolongan" placeholder="">
                                </div>
                            </div> 
                            <div id="map">
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
          <!-- end modal tambah   -->

           <!-- modal edit Data -->
           <div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Peristiwa Bencana/Lainnya</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                        <form name="sdform" action="{{config('app.url')}}/bencana_kebakaran/update" id="formdata" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="mb-3 row">
                                <label for="tanggalkegiatan_edit" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggalkegiatan_edit" name="tanggalkegiatan_edit" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="waktu_edit" class="col-sm-2 col-form-label">Waktu</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="waktu_edit" name="waktu_edit" aria-label=".form-select-lg example">
                                    <option selected>--Pilih--</option>
                                    <option value="Pagi">Pagi</option>
                                    <option value="Siang">Siang</option>
                                    <option value="Sore">Sore</option>
                                </select>
                            </div>
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
                                <label for="kelurahan_edit" class="col-sm-2 col-form-label">Kelurahan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kelurahan_edit" name="kelurahan_edit" >
                                </div>
                            </div>
                           
                            <div class="mb-3 row">
                                <label for="jenisbencana_edit" class="col-sm-2 col-form-label">Jenis Bencana</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jenisbencana_edit" name="jenisbencana_edit" aria-label=".form-select-lg example">
                                    <option selected>Pilih Jenis Bencana</option>
                                    <option Value="Banjir">Banjir</option>
                                    <option Value="Gempa Bumi">Gempa Bumi</option>
                                    <option Value="Kebakaran">Kebakaran</option>
                                    <option Value="Tsunami">Tsunami/option>
                                    <option Value="Gunung Meletus">Gunung Meletus</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="sifatbencana_edit" class="col-sm-2 col-form-label">Sifat Bencana</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="sifatbencana_edit" name="sifatbencana_edit" aria-label=".form-select-lg example">
                                    <option selected>Pilih Sifat Bencana</option>
                                    <option value="Lokal">Lokal</option>
                                    <option value="Nasional">Nasional</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="korbanmanusia_edit" class="col-sm-2 col-form-label">Korban Manusia</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="korbanmanusia_edit" name="korbanmanusia_edit" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="korbanmeteriil_edit" class="col-sm-2 col-form-label">Korban Materiil</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="korbanmeteriil_edit" name="korbanmeteriil_edit" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jenispertolongan_edit" class="col-sm-2 col-form-label">Jenis Pertolongan</label>
                                <div class="col-sm-6">   
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="korbanmeteriil_edit" name="korbanmeteriil_edit" placeholder="">
                                </div>
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
 @include('Pages.Bencana.script')
@endsection

@endsection
