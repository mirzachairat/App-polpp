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
    #locationPicker{ 
                    height: 300px;
                    width: 100%;
                    display: block;
                    position: relative;
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
            Jumlah Personil Linmas                </h3>
    </div>
    <hr>

    <div class="box-content">

        
        <form method="post" name="form1" class="form-horizontal form-bordered">

            @csrf
            <div align="right">
                <!-- <a class="btn btn-green" href="https://satpolpp.kemendagri.go.id/personil_linmas/tambih "><i class="icon-plus-sign"></i> Tambah Data</a> -->
                <button type="button" class="btn btn-danger" id="buttontambah" data-bs-toggle="modal" data-bs-target="#modaltambah"><i class="bi bi-plus-lg"></i>
                    Tambah Data
                </button>
            </div>
            <br>
            <div class="table-responsive">
                <table width="100%" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">NO</th>
                            <th rowspan="2">NAMA KABUPATEN/KOTA</th>
                            <th rowspan="2">NAMA KECAMATAN</th>
                            <th rowspan="2">NAMA DESA</th>
                            <th rowspan="2">NAMA KELURAHAN</th>
                            <th colspan="2">JENIS KELAMIN SATLINMAS</th>
                            <th rowspan="2">JENIS SATLINMAS</th>
                            <th colspan="2">SUDAH MENGIKUTI BIMTEK</th>
                            <th rowspan="2">NOMOR SK PELANTIKAN</th>
                            <th rowspan="2">Opsi</th>
                        </tr>
                        <tr>
                            <th>LAKI-LAKI</th>
                            <th>PEREMPUAN</th>
                            <th>APBD</th>
                            <th>APBN</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tbody>
                            <?php $i = 0?>
                            @foreach($featuresdata as $feature)
                            <?php $i++?>
                            <tr id="ids{{$feature->attributes->objectid}}">
                                    <td>{{$i}}</td>
                                    <td>{{$feature->attributes->kabkota}}</td>
                                    <td>{{$feature->attributes->kecamatan}}</td>
                                    <td>{{$feature->attributes->keldes}}</td>
                                    <td></td>
                                    <td>{{$feature->attributes->jeniskelamin}}</td>
                                    <td></td>
                                    <td>{{$feature->attributes->jenissatlinmas}}</td>
                                    <td>{{$feature->attributes->smbad}}</td>
                                    <td>{{$feature->attributes->smban}}</td>
                                    <td>{{$feature->attributes->noskpelantikan}}</td>
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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jumlah Personil Linmas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ui-front">
                            <form name="sdform" action="{{config('app.url')}}/datalinmas/store" id="formdata" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="mb-3 row">
                                <label for="namobj" class="col-sm-2 col-form-label">Nama Anggota LINMAS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namobj" name="namobj" placeholder="">
                                </div>
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
                                <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jeniskelamin" name="jeniskelamin" aria-label=".form-select-lg example">
                                    <option selected>Silahkan Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="jenissatlinmas" class="col-sm-2 col-form-label">Jenis Satlinmas</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jenissatlinmas" name="jenissatlinmas" aria-label=".form-select-lg example">
                                    <option selected>Silahkan Pilih Jenis Satlinmas</option>
                                    <option value="Baru">Baru</option>
                                    <option value="Lama">Lama</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="smbad" class="col-sm-2 col-form-label">Sudah Mengikuti BIMTEK APBD</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="smbad" name="smbad" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="smban" class="col-sm-2 col-form-label">Sudah Mengikuti BIMTEK APBN</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="smban" name="smban" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="noskpelantikan" class="col-sm-2 col-form-label">No SK Pelantikan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="noskpelantikan" name="noskpelantikan" placeholder="">
                                </div>
                            </div>
                            <div id="map"></div>                    
                            <input type="text" name="Latitude" id="Latitude" />
						    <input type="text" name="Longitude" id="Longitude" />
                            <input type="text" name="koordinat" id="koordinat">                     
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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jumlah Personil Linmas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                            <form name="sdform" action="{{config('app.url')}}/datalinmas/update" method="post" id="formdata_edit" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="objectid" id="objectid" name="objectid">
                            <div class="mb-3 row">
                                <label for="kabkota_edit" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kabkota_edit" name="kabkota" placeholder="kecamatan">
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="kecamatan_edit" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kecamatan_edit" name="kecamatan" placeholder="kecamatan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keldes_edit" class="col-sm-2 col-form-label">Desa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="keldes_edit" name="keldes" placeholder="Desa">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kelurahan_edit" class="col-sm-2 col-form-label">Kelurahan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kelurahan_edit" name="kelurahan" placeholder="Kelurahan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jeniskelamin_edit" name="jeniskelamin" aria-label=".form-select-lg example">
                                    <option selected></option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="jenissatlinmas" class="col-sm-2 col-form-label">Jenis Satlinmas</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jenissatlinmas_edit" name="jenissatlinmas" aria-label=".form-select-lg example">
                                    <option selected>Silahkan Pilih Jenis Satlinmas</option>
                                    <option value="Baru">Baru</option>
                                    <option value="Lama">Lama</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="smbad_edit" class="col-sm-2 col-form-label">Sudah Mengikuti BIMTEK APBD</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="smbad_edit" name="smbad" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="smban_edit" class="col-sm-2 col-form-label">Sudah Mengikuti BIMTEK APBN</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="smban_edit" name="smban" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="noskpelantikan_edit" class="col-sm-2 col-form-label">No SK Pelantikan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="noskpelantikan_edit" name="noskpelantikan" placeholder="">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="submitdata" onclick="updateDataAjax()">Submit</button>
                               <!-- <a href="javascript:void(0)" class="btn btn-primary" id="updateData" onclick="updateData()">Submit</a> -->
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
 @include('Pages.Datalinmas.script')
@endsection

@endsection
