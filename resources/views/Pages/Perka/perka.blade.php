@extends('Layouts.layout')
@section('content')
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
            Penegakan Peraturan Kepala Daerah
        </h3>
    </div>
    <hr>
    <div class="box-content">

        
        <form action="https://satpolpp.kemendagri.go.id/personil_linmas/index" method="post" name="form1" class="form-horizontal form-bordered">

            @csrf
            <div align="right">
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
            <div class="row">
                <label class="control-label" for="textfield">Periode Tanggal</label>
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInput">Name</label>
                        <input type="date" class="form-control mb-2" id="inlineFormInput" placeholder="Masukan kata kunci">
                    </div>
                    s/d
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInput">Name</label>
                        <input type="date" class="form-control mb-2" id="inlineFormInput" placeholder="Masukan kata kunci">
                    </div>
                 </div>
            </div>
           
            <!-- <div class="control-group">
                <label class="control-label" for="textfield">Pencarian</label>
                <div class="controls">
                    <input type="text" value="" class="form-control" name="cari_personil_linmas" placeholder="Masukan kata kunci... (Nama)">
                    <input type="submit" name="submit" value="Cari" class="btn btn-blue btn-sm">
                    <a class="btn btn-red" href="https://satpolpp.kemendagri.go.id/personil_linmas/clear_session"><i class="icon-trash"></i> Hapus Pencarian</a>
                </div>
            </div> -->
            
            <div class="table-responsive">
                <table width="100%" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TGL.KEGIATAN</th>
                            <th>WAKTU<br/>KEGIATAN</th>
                            <th>NOMOR PERKADA YANG DILANGGAR</th>
                            <th>JENIS PELANGGARAN PERKADA</th>
                            <th>KET</th>
                            <th width="5%" style="text-align: center">Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tbody>
                            <?php $i = 0?>
                           
                            <?php $i++?>
                            <tr>
                                    
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="editModal"><i class="fas fa-eye"></i></a>||
                                        <!-- <a class="btn btn-warning btn-sm" id="delete"><i class="far fa-trash-alt"></i></a> -->
                                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" id="delete"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                           
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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penegakan Peraturan Kepala Daerah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form name="sdform" action="{{config('app.url')}}/datalinmas/store" id="formdata" method="post" enctype="multipart/form-data">
                                @csrf
                            <!-- <div class="mb-3 row">
                                <label for="kabkota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kabkota" name="kabkota">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keldes" class="col-sm-2 col-form-label">Desa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="keldes" name="keldes" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan" >
                                </div>
                            </div> -->
                            <div class="mb-3 row">
                                <label for="kelurahan" class="col-sm-2 col-form-label">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jeniskelamin" class="col-sm-2 col-form-label">Waktu Kegiatan</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jeniskelamin" name="jeniskelamin" aria-label=".form-select-lg example">
                                    <option selected>Pilih</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="jeniskelamin" class="col-sm-2 col-form-label">Perkada Yang Dilanggar</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jeniskelamin" name="jeniskelamin" aria-label=".form-select-lg example">
                                    <option selected>Pilih</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="kelurahan" class="col-sm-2 col-form-label">Jenis Pelanggaran</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kelurahan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan">
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
          <!-- end modal tambah   -->

           <!-- modal edit Data -->
           <div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penegakan Peraturan Kepala Daerah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                        <form name="sdform" action="{{config('app.url')}}/datalinmas/store" id="formdata" method="post" enctype="multipart/form-data">
                                @csrf
                            <!-- <div class="mb-3 row">
                                <label for="kabkota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kabkota" name="kabkota">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keldes" class="col-sm-2 col-form-label">Desa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="keldes" name="keldes" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan" >
                                </div>
                            </div> -->
                            <div class="mb-3 row">
                                <label for="kelurahan" class="col-sm-2 col-form-label">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jeniskelamin" class="col-sm-2 col-form-label">Waktu Kegiatan</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jeniskelamin" name="jeniskelamin" aria-label=".form-select-lg example">
                                    <option selected>Pilih</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="jeniskelamin" class="col-sm-2 col-form-label">Perkada Yang Dilanggar</label>
                                <div class="col-sm-6">   
                                <select class="form-select form-select-sm mb-3" id="jeniskelamin" name="jeniskelamin" aria-label=".form-select-lg example">
                                    <option selected>Pilih</option>
                                </select>
                                </div>    
                            </div>
                            <div class="mb-3 row">
                                <label for="kelurahan" class="col-sm-2 col-form-label">Jenis Pelanggaran</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kelurahan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan">
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
 @include('Pages.Datalinmas.script')
@endsection

@endsection
