@extends('opd.opd_temp')
@section('judul', 'Data Cuti Pegawai')
@section('side_kel', 'active')
@section('side_kel2', 'show')
@section('side_dama', 'active')
@section('judul2', 'Data Cuti Pegawai')
@section('tambah_css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/fixedHeader.dataTables.min.css') }}">
@endsection



@section('isi')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    {{-- <h3 class="mb-0  float-left">Buat data cuti baru</h3> --}}
                    <button id="modal_cuti" class="btn btn-primary float-right"><i class="fa fa-paper-plane"> </i> Usul
                        Cuti</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">Data Cuti</h3>

                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable33">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Jenis Cuti</th>
                                <th>Tanggal Cuti</th>
                                <th>Diajukan</th>
                                {{-- <th style="width: 5%">Status</th> --}}
                                <th style="width: 5%">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_add_cuti" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5e72e4">
                    <h5 class="modal-title" style="color: white;">Form Usulan Cuti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style=" color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form_add" action="{{ route('opd.tambah.cuti') }}" enctype="multipart/form-data"
                    onsubmit="return confirm('Cuti akan diajukan, Pastikan data yang dimasukkan sudah benar?!');"
                    class="d-inline">
                    {{ csrf_field() }}

                    <div class="modal-body">

                        <input class="form-control" name="id_pegawai" id="id_pegawai" value="" hidden>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Pilih Pegawai</label>
                            <div class="col-md-10">

                                <select id="peg_pilihan" class="cari form-control select2">
                                    <option value="#" selected disabled>- Pilih Pegawai -</option>
                                    @foreach ($pegawai as $peg)
                                        <option value="{{ $peg->id_pegawai }}">{{ $peg->nama_pegawai }} (
                                            {{ $peg->nip }} )</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control" id="nama" type="text" value="" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">NIP</label>
                            <div class="col-md-10">
                                <input class="form-control" id="nip" type="text" disabled value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Jabatan</label>
                            <div class="col-md-10">
                                <input class="form-control" id="jabatan" type="text" disabled value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Masa Kerja</label>
                            <div class="col-md-4">
                                <input class="form-control" id="masa1" type="text" disabled value="">
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label col-sm-12 form-control-label">Tahun</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" id="masa2" type="text" disabled value="">
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label col-sm-12 form-control-label">Bulan</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Unit Kerja</label>
                            <div class="col-md-10">
                                <input class="form-control" id="unit" type="text" disabled value="">
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Jenis Cuti</label>
                            <div class="col-md-10">

                                <select class="form-control select2 sudah_pilih" id="jenis_c" name="jen_c" required>
                                    <option value="#" selected disabled>- Pilih Jenis Cuti -</option>
                                    <option value="1">Cuti Tahunan</option>
                                    <option value="2">Cuti Besar</option>
                                    <option value="3">Cuti Sakit</option>
                                    <option value="4">Cuti Melahirkan</option>
                                    <option value="5">Cuti Alasan Penting</option>
                                    <option value="6">Cuti di Luar Tanggungan Negara</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Alasan Cuti</label>
                            <div class="col-md-10">
                                <textarea class="form-control sudah_pilih" name="alasan_c" id="v_alasan" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Tanggal Cuti</label>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label form-control-label">Dari</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control sudah_pilih" id="tgl_awal" name="tgl_aw_c" type="date"
                                    value="" required>
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label form-control-label">Sampai</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control sudah_pilih" id="tgl_akhir" name="tgl_ak_c" type="date"
                                    value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Selama</label>
                            <div class="col-md-2">
                                <input class="form-control" id="diff_hari" type="text" value="" disabled>
                                <input class="form-control" id="diff_hari_con" type="text" name="lama_c" hidden
                                    value="">
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label form-control-label">Hari</label>
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">

                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <label class="form-control-label">Catatan Cuti</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti Tahunan</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_" id="v_t" class="form-control sudah_pilih" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label"></label>
                            <div class="col-md-1">
                                <label class="col-form-label form-control-label">Jumlah</label>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" id="jum_t" type="text" value="" disabled>
                            </div>
                            <div class="col-md-1">

                                <label class="col-form-label form-control-label">Sisa</label>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" id="sisa_t" type="text" value="" disabled>
                                <input class="form-control" id="sisa_t_con" hidden type="text" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti Besar</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_t" id="v_b" class="form-control sudah_pilih" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti Sakit</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_s" id="v_s" class="form-control sudah_pilih" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti Melahirkan</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_m" id="v_m" class="form-control sudah_pilih" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti Alasan Penting</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_ap" id="v_ap" class="form-control sudah_pilih" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti di Luar Tanggungan
                                Negara</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_dlt" id="v_dtn" class="form-control sudah_pilih" rows="1"></textarea>
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Alamat Cuti</label>
                            <div class="col-md-10">
                                <textarea name="alamat_c" id="v_alamat" class="form-control sudah_pilih" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Nomor Telepon</label>
                            <div class="col-md-10">
                                <input type="number" id="v_notel" name="nomor_telp_c"
                                    class="form-control sudah_pilih">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-right"><button id="btn_print_file" type="button"
                                    class="btn btn-warning"><i class="fa fa-print"></i> Print File Permohonan
                                    Cuti</button>
                            </div>
                        </div>


                        <hr style="border-top: 1px solid black;">

                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <label class="form-control-label">Upload Berkas</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Scan SK terakhir</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" accept="application/pdf" name="file_sk"
                                    required>
                                <small style="color: red">*file berformat PDF, dengan ukuran maksimal 2 MB</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Scan Rekap Absen</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" accept="application/pdf" name="file_absen"
                                    required>
                                <small style="color: red">*file berformat PDF, dengan ukuran maksimal 2 MB</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Scan Permohonan
                                Cuti</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" accept="application/pdf"
                                    name="file_permohonan" required>
                                <small style="color: red">*file berformat PDF, dengan ukuran maksimal 2 MB</small>
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">

                    </div>
                    <div class="modal-footer" style="margin-top: -50px">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button id="butt_sub" type="button" class="btn btn-warning"><i class="fa fa-edit"></i> Ajukan
                            Cuti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_edit_cuti" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5e72e4">
                    <h5 class="modal-title" style="color: white;">Usulan Cuti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style=" color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form_add" action="{{ route('opd.edit.cuti') }}"
                    onsubmit="return confirm('Cuti akan diajukan, Pastikan data yang dimasukkan sudah benar?!');"
                    class="d-inline">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input class="form-control" name="e_id" id="e_id" value="" hidden>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control  edit_view_eee" id="e_nama" type="text" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">NIP</label>
                            <div class="col-md-10">
                                <input class="form-control   edit_view_eee" id="e_nip" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Jabatan</label>
                            <div class="col-md-10">
                                <input class="form-control   edit_view_eee" id="e_jabatan" type="text"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Masa Kerja</label>
                            <div class="col-md-4">
                                <input class="form-control  edit_view_eee" id="e_masa1" type="text" value="">
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label col-sm-12 form-control-label">Tahun</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control  edit_view_eee" id="e_masa2" type="text" value="">
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label col-sm-12 form-control-label">Bulan</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Unit Kerja</label>
                            <div class="col-md-10">
                                <input class="form-control  edit_view_eee" id="e_unit" type="text" value="">
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Jenis Cuti</label>
                            <div class="col-md-10">

                                <select class="form-control edit_view select2" id="e_jenis_c" name="jen_c" required>
                                    <option value="#" selected disabled>- Pilih Jenis Cuti -</option>
                                    <option value="1">Cuti Tahunan</option>
                                    <option value="2">Cuti Besar</option>
                                    <option value="3">Cuti Sakit</option>
                                    <option value="4">Cuti Melahirkan</option>
                                    <option value="5">Cuti Alasan Penting</option>
                                    <option value="6">Cuti di Luar Tanggungan Negara</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Alasan Cuti</label>
                            <div class="col-md-10">
                                <textarea class="form-control edit_view" name="alasan_c" id="e_alasan_c" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Tanggal Cuti</label>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label form-control-label">Dari</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control edit_view" id="e_tgl_awal" name="tgl_aw_c" type="date"
                                    value="" required>
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label form-control-label">Sampai</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control edit_view" id="e_tgl_akhir" name="tgl_ak_c" type="date"
                                    value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Selama</label>
                            <div class="col-md-2">
                                <input class="form-control edit_view" id="e_diff_hari" type="text" value=""
                                    disabled>
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label form-control-label">Hari</label>
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">

                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <label class="form-control-label">Catatan Cuti</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti Tahunan</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_" id="e_catatan_c_t" class="form-control  edit_view" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label"></label>
                            <div class="col-md-1">
                                <label class="col-form-label form-control-label">Jumlah</label>
                            </div>
                            <div class="col-md-2">

                                <input class="form-control" id="e_jum_t" type="text" value="" disabled>
                            </div>
                            <div class="col-md-1">

                                <label class="col-form-label form-control-label">Sisa</label>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" id="e_sisa_t" type="text" value="" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti Besar</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_t" id="e_catatan_c_b" class="form-control edit_view" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti Sakit</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_s" id="e_catatan_c_s" class="form-control edit_view" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti Melahirkan</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_m" id="e_catatan_c_m" class="form-control edit_view" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti Alasan Penting</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_ap" id="e_catatan_c_ap" class="form-control edit_view" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Cuti di Luar Tanggungan
                                Negara</label>
                            <div class="col-md-10">
                                <textarea name="catatan_c_dlt" id="e_catatan_c_cdlt" class="form-control edit_view" rows="1"></textarea>
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Alamat Cuti</label>
                            <div class="col-md-10">
                                <textarea name="alamat_c" id="e_alamat_c" class="form-control edit_view" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Nomor Telepon</label>
                            <div class="col-md-10">
                                <input type="number" id="e_notelp_c" name="nomor_telp_c"
                                    class="form-control edit_view">
                            </div>

                        </div>

                        <hr style="border-top: 1px solid black;">

                        <div id="file_view">
                            <div class="row mb-3">
                                <div class="col-12 text-center">
                                    <label class="form-control-label">File SK</label>
                                </div>
                            </div>
                            <iframe id="v_file_1" src="" width="100%" height="500px">
                            </iframe>
                            <div class="row mb-3">
                                <div class="col-12 text-center">
                                    <label class="form-control-label">File Rekap Absen</label>
                                </div>
                            </div>
                            <iframe id="v_file_2" src="" width="100%" height="500px">
                            </iframe>
                            <div class="row mb-3">
                                <div class="col-12 text-center">
                                    <label class="form-control-label">File Permohonan Cuti</label>
                                </div>
                            </div>
                            <iframe id="v_file_3" src="" width="100%" height="500px">
                            </iframe>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-top: -50px" id="btn_foot">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button id="e_butt_sub" type="button" class="btn btn-warning"><i class="fa fa-edit"></i> Edit
                            Detail
                            Cuti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id='DivIdToPrint'>
        <table width="100%">
            <thead class="thead-light text-center" style="font-family: 'Times New Roman', Times, serif; ">
                <tr>
                    <th style="width:70%;"></th>
                    <th style="width:30%; font-weight: normal; text-align:left;font-size: 14px;">
                        Bungku, {{ date('d F Y') }}
                        <br>
                        <br>
                        <span>
                            Kepada <br>
                            <span style="margin-left: -30px;">
                                Yth,&nbsp; Kepala Badan
                                Kepegawaian</span><br>
                            Pengembangan Dan Sumber Daya <br>
                            Manusia Daerah Kab.Morowali <br>
                            Di <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;Tempat

                        </span><br>
                    </th>
                </tr>
            </thead>
        </table>
        <br>

        <table border="1" bordercolorlight="#b9dcff" width="100%" style="border-collapse: collapse;">
            <thead class="thead-light text-center" style="font-family: 'Times New Roman', Times, serif; font-size: 12px;">
                <tr>
                    <th colspan="4"
                        style="width:100%; font-weight: normal; border-top: 1px solid rgb(255, 255, 255); border-left: 1px solid rgb(255, 255, 255); border-right: 1px solid rgb(255, 255, 255);">
                        FORMULIR PERMINTAAN DAN PEMBERIAN CUTI
                    </th>
                </tr>
                <tr>
                    <th colspan="4" style="width:100%; font-weight: normal; text-align: left; padding-left: 5px;">I.
                        DATA PEGAWAI
                    </th>
                </tr>
                <tr>
                    <th style="width:15%; font-weight: normal; text-align: left; padding-left: 5px;">Nama</th>
                    <th colspan="3" style="font-weight: normal; text-align: left; padding-left: 5px;"><span
                            id="tb_nama"></span>
                    </th>
                </tr>
                <tr>
                    <th style="width:15%; font-weight: normal; text-align: left; padding-left: 5px;">NIP</th>
                    <th colspan="3" style="font-weight: normal; text-align: left; padding-left: 5px;"><span
                            id="tb_nip"></span>
                    </th>
                </tr>
                <tr>
                    <th style="width:15%; font-weight: normal; text-align: left; padding-left: 5px;">Jabatan</th>
                    <th colspan="3" style="font-weight: normal; text-align: left; padding-left: 5px;"><span
                            id="tb_jabatan"></span>
                    </th>
                </tr>
                <tr>
                    <th style="width:15%; font-weight: normal; text-align: left; padding-left: 5px;">Masa Kerja</th>
                    <th colspan="3" style="font-weight: normal; text-align: left; padding-left: 5px;"><span
                            id="tb_masa_kerja"></span><span id="tb_masa_kerja_2"></span></th>
                </tr>
                <tr>
                    <th style="width:15%; font-weight: normal; text-align: left; padding-left: 5px;">Unit Kerja</th>
                    <th colspan="3" style="font-weight: normal; text-align: left; padding-left: 5px;"><span
                            id="tb_unit_kerja"></span></th>
                </tr>

                <tr>
                    <th colspan="4" style="font-weight: normal; text-align: left; padding-left: 5px;"><br></th>
                </tr>

                <tr>
                    <th colspan="4" style="width:100%; font-weight: normal;">II. JENIS CUTI YANG DIAMBIL</th>
                </tr>
                <tr>
                    <th colspan="4" style="width:100%; font-weight: normal; text-align: left; padding-left: 5px;"><span
                            id="tb_jenis_cuti"></span></th>
                </tr>

                <tr>
                    <th colspan="4" style="font-weight: normal; text-align: left; padding-left: 5px;"><br></th>
                </tr>

                <tr>
                    <th colspan="4" style="width:100%; font-weight: normal;">III. ALASAN CUTI</th>
                </tr>
                <tr>
                    <th colspan="4" style="width:100%; font-weight: normal; text-align: left;  padding-left: 5px;">
                        <span id="tb_alasan"></span>
                    </th>
                </tr>

                <tr>
                    <th colspan="4" style="font-weight: normal; text-align: left; padding-left: 5px;"><br></th>
                </tr>

                <tr>
                    <th colspan="4" style="width:100%; font-weight: normal;">IV. LAMANYA CUTI</th>
                </tr>
                <tr>
                    <th style="width:15%; font-weight: normal; text-align: left; padding-left: 5px;">Selama</th>
                    <th style="font-weight: normal; text-align: left; padding-left: 5px;"><span id="tb_selama"></span>
                    </th>
                    <th style="width:15%; font-weight: normal; text-align: left; padding-left: 5px;">Mulai Tanggal</th>
                    <th style="font-weight: normal; text-align: left; padding-left: 5px;"><span id="tb_tanggal"></span>
                    </th>
                </tr>
            </thead>
        </table>

        <table border="1" bordercolorlight="#b9dcff" width="100%"
            style="border-collapse: collapse; border-top: unset;">
            <thead class="thead-light text-center" style="font-family: 'Times New Roman', Times, serif; font-size: 12px;">
                <tr>
                    <th colspan="5" style="width:100%; font-weight: normal; text-align: left; padding-left: 5px;">V.
                        CATATAN CUTI
                    </th>
                </tr>
                <tr>
                    <th colspan="3" style="width:50%; font-weight: normal; text-align: left; padding-left: 5px;">1.
                        Cuti Tahunan</th>
                    <th style="width:15%; font-weight: normal; text-align: left; padding-left: 5px;"> 2.
                        Cuti Besar
                    </th>
                    <th style="width:35%; font-weight: normal; text-align: left; padding-left: 5px;"><span
                            id="tb_ct_b"></span>
                    </th>
                </tr>
                <tr>
                    <th style="width:5%; font-weight: normal; text-align: center;">Tahun</th>
                    <th style="width:5%; font-weight: normal; text-align: center;">Sisa</th>
                    <th style="width:40%; font-weight: normal; text-align: center;">Keterangan</th>
                    <th style="font-weight: normal; text-align: left; padding-left: 5px;"> 3.
                        Cuti Sakit
                    </th>
                    <th style="font-weight: normal; text-align: left; padding-left: 5px;"><span id="tb_ct_s"></span>
                    </th>
                </tr>
                <tr>
                    <th style="font-weight: normal; text-align: center;">N-2</th>
                    <th style="font-weight: normal; text-align: center;"></th>
                    <th style="font-weight: normal; text-align: center;"></th>
                    <th style="font-weight: normal; text-align: left; padding-left: 5px;"> 4.
                        Cuti Melahirkan
                    </th>
                    <th style="font-weight: normal; text-align: left; padding-left: 5px;"><span id="tb_ct_m"></span>
                    </th>
                </tr>
                <tr>
                    <th style="font-weight: normal; text-align: center;">N-1</th>
                    <th style="font-weight: normal; text-align: center;"></th>
                    <th style="font-weight: normal; text-align: center;"></th>
                    <th style="font-weight: normal; text-align: left; padding-left: 5px;"> 5.
                        Cuti Karena Alasan Penting
                    </th>
                    <th style="font-weight: normal; text-align: left; padding-left: 5px;"><span id="tb_ct_ap"></span>
                    </th>
                </tr>
                <tr>
                    <th style="font-weight: normal; text-align: center;">N</th>
                    <th style="font-weight: normal; text-align: center;"><span id="tb_sisa"></span></th>
                    <th style="font-weight: normal; text-align: left; padding-left: 5px;"><span id="tb_ct_t"></th>
                    <th style="font-weight: normal; text-align: left; padding-left: 5px;"> 6.
                        Cuti Di Luar Tanggungan Negara
                    </th>
                    <th style="font-weight: normal; text-align: left; padding-left: 5px;"><span id="tb_ct_dtn"></span>
                    </th>
                </tr>
            </thead>
        </table>

        <table border="1" bordercolorlight="#b9dcff" width="100%"
            style="border-collapse: collapse; border-top: unset;">
            <thead class="thead-light text-center" style="font-family: 'Times New Roman', Times, serif; font-size: 12px;">
                <tr>
                    <th colspan="5" style="width:100%; font-weight: normal; text-align: left; padding-left: 5px;">V.
                        ALAMAT SELAMA MENJALANKAN CUTI
                    </th>
                </tr>
                <tr>
                    <th colspan="3" style="width:50%; font-weight: normal; text-align: left; padding-left: 5px;"><span
                            id="tb_alamat"></span></th>
                    <th style="width:10%; font-weight: normal; text-align: left;  padding-left: 5px;">Telepon</th>
                    <th style="width:40%;font-weight: normal; text-align: left;  padding-left: 5px;"><span
                            id="tb_telp"></span></th>
                </tr>
                <tr>
                    <th colspan="3" style="width:50%; font-weight: normal; text-align: center;"><span
                            id="tb_alamat"></span></th>
                    <th colspan="2" style="font-weight: normal; text-align: center;  padding-left: 5px;">Hormat Saya,
                        <br><br><br><br><br>
                    </th>
                </tr>
                <tr>
                    <th colspan="5" style="width:100%; font-weight: normal; text-align: left; padding-left: 5px;">VII.
                        PERTIMBANGAN ATASAN LANGSUNG
                    </th>
                </tr>
                <tr>
                    <th style="width:15%; font-weight: normal; text-align: center;">Disetujui</th>
                    <th style="width:15%; font-weight: normal; text-align: center;">Perubahan</th>
                    <th style="width:15%; font-weight: normal; text-align: center;">Ditangguhkan</th>
                    <th colspan="2" style="width:50%; font-weight: normal;  text-align: center;">Tidak Disetujui</th>
                </tr>
                <tr>
                    <th style="width:15%; font-weight: normal; text-align: center;"><br></th>
                    <th style="width:15%; font-weight: normal; text-align: center;"></th>
                    <th style="width:15%; font-weight: normal; text-align: center;"></th>
                    <th colspan="2" style="width:50%; font-weight: normal;  text-align: center;"></th>
                </tr>
                <tr>
                    <th colspan="3" style="width:50%; font-weight: normal; text-align: center;"></th>
                    <th colspan="2" style="font-weight: normal; text-align: center;  padding-left: 5px;"><br>
                        <b>PIMPINAN OPD</b>
                        <br><br><br><br><br><br><br><br><br><br>
                    </th>
                </tr>
            </thead>
        </table>
    </div>

@endsection

@section('tambah_js')
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/nouislider/distribute/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/sweet.min.js') }}"></script>

    <script src="{{ asset('vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            loadData();

            $("#DivIdToPrint").hide();
            $(".select2").select2();

            $(".sudah_pilih").prop("disabled", true);
            $(".edit_view").prop("disabled", true);
            $("#btn_foot").hide(200);
            $("#file_view").hide(200);

        });



        $("#btn_print_file").click(() => {
            $("#tb_jenis_cuti").text($("#jenis_c").find("option:selected").text());
            $("#tb_alasan").text($("#v_alasan").val());
            $("#tb_selama").text($("#diff_hari").val());
            $("#tb_tanggal").text(format(new Date($("#tgl_awal").val())) + " s/d " + format(new Date($("#tgl_akhir").val())));
            $("#tb_sisa").text($("#sisa_t_con").val());
            $("#tb_ct_b").text($("#v_b").val());
            $("#tb_ct_s").text($("#v_s").val());
            $("#tb_ct_m").text($("#v_m").val());
            $("#tb_ct_ap").text($("#v_ap").val());
            $("#tb_ct_dtn").text($("#v_dtn").val());
            $("#tb_ct_t").text($("#v_t").val());
            $("#tb_alamat").text($("#v_alamat").val());
            $("#tb_telp").text($("#v_notel").val());
            // v_t            
            print();
        })

        function print() {
            var divToPrint = document.getElementById('DivIdToPrint');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
            newWin.document.close();
            setTimeout(function() {
                newWin.close();
            }, 10);
        }

        function format(inputDate) {
            let date, month, year;

            date = inputDate.getDate();
            month = inputDate.getMonth() + 1;
            year = inputDate.getFullYear();

            date = date.toString().padStart(2, "0");

            month = month.toString().padStart(2, "0");

            return `${date}-${month}-${year}`;
        }

        $("#tgl_awal").on("change", function() {
            var start = new Date($("#tgl_awal").val());
            var end = new Date($("#tgl_akhir").val());
            var diff = new Date(end - start);
            var days = diff / 1000 / 60 / 60 / 24;
            $("#diff_hari").val(days);
            $("#diff_hari_con").val(days);
        });

        $("#tgl_akhir").on("change", function() {
            var start = new Date($("#tgl_awal").val());
            var end = new Date($("#tgl_akhir").val());
            var diff = new Date(end - start);
            var days = diff / 1000 / 60 / 60 / 24;
            $("#diff_hari_con").val(days);
            $("#diff_hari").val(days);
        });

        $("#modal_cuti").click(function() {
            $("#modal_add_cuti").modal("show");
        });

        $("#peg_pilihan").on("change", function() {
            var id_peg = $("#peg_pilihan option:selected").val();
            $.ajax({
                url: "{{ route('opd.get.pegawai') }}",
                type: "get",
                data: {
                    id: id_peg,
                },
                success: function(data) {
                    $("#id_pegawai").val(data.id_pegawai);
                    $("#nama").val(data.nama_pegawai);
                    $("#nip").val(data.nip);
                    $("#jabatan").val(data.jabatan);
                    $("#masa1").val(data.mk_thn);
                    $("#masa2").val(data.mk_bln);
                    $("#unit").val(data.nama_opd);
                    $(".sudah_pilih").prop("disabled", false);

                    //print

                    $("#tb_nama").text(data.nama_pegawai);
                    $("#tb_nip").text(data.nip);
                    $("#tb_jabatan").text(data.jabatan);
                    $("#tb_masa_kerja").text(data.mk_thn + " Tahun  ");
                    $("#tb_masa_kerja_2").text(" " + data.mk_bln + " Bulan");
                    $("#tb_unit_kerja").text(data.nama_opd);
                },
                error: function(error) {
                    console.log(error);
                    error_detail(error);
                },
            });

            $.ajax({
                url: "{{ route('opd.get.pegawai.cuti') }}",
                type: "get",
                data: {
                    id: id_peg,
                },
                success: function(data) {
                    value = 12 - data;
                    $("#jum_t").val(data);
                    $("#sisa_t").val(value);
                    $("#sisa_t_con").val(value);
                },
                error: function(error) {
                    console.log(error);
                    error_detail(error);
                },
            });
        });

        $("#butt_sub").click(function() {
            err1 = $("#diff_hari").val();
            err2 = $("#sisa_t").val();
            err4 = $("#jenis_c").val();
            err3 = err2 - err1;
            if (err4 == 1) {
                if (err3 <= 0) {
                    alert("Jumlah hari cuti telah melebihi kuota Cuti");
                } else {
                    $("#form_add").submit();
                }
            } else {
                $("#form_add").submit();
            }
        });

        function loadData() {
            $("#datatable33").DataTable({
                paging: false,
                destroy: true,
                info: true,
                searching: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('opd.get.cuti') }}",
                    type: "GET",
                },
                aoColumnDefs: [{
                        bSortable: false,
                        aTargets: [3, 4, 6],
                    },
                    {
                        bSearchable: false,
                        aTargets: [3, 4, 6],
                    },
                ],
                columns: [{
                        data: null,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: "nip",
                    },
                    {
                        data: "nama_pegawai",
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (data.jenis_cuti == 1) {
                                return '<span class="badge badge-pill badge-lg light badge-success"> Cuti Tahunan</span>';
                            } else if (data.jenis_cuti == 2) {
                                return '<span class="badge badge-pill badge-lg light badge-success"> Cuti Besar</span>';
                            } else if (data.jenis_cuti == 3) {
                                return '<span class="badge badge-pill badge-lg light badge-success"> Cuti Sakit</span>';
                            } else if (data.jenis_cuti == 4) {
                                return '<span class="badge badge-pill badge-lg light badge-success"> Cuti Melahirkan</span>';
                            } else if (data.jenis_cuti == 5) {
                                return '<span class="badge badge-pill badge-lg light badge-success"> Cuti Alasan Penting</span>';
                            } else if (data.jenis_cuti == 6) {
                                return '<span class="badge badge-pill badge-lg light badge-success"> Cuti di Luar Tanggungan Negara</span>';
                            }
                        },
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            result = format(new Date(data.tgl_awal));
                            result2 = format(new Date(data.tgl_akhir));
                            return "" + result + "  s/d  " + result2;
                        },
                    },
                    {
                        data: "created_at",
                        render: function(data, type, row) {
                            result = format(new Date(data));
                            return "" + result;
                        },
                    },
                    // {
                    //     data: null,
                    //     render: function(data, type, row) {
                    //         if (data.status == 0) {
                    //             return '<span class="badge badge-pill badge-lg light badge-info"><i class="fa fa-exclamation-triangle"></i> Menunggu Proses</span>';
                    //         } else if (data.status == 1) {
                    //             return '<span class="badge badge-pill badge-lg light badge-danger"><i class="fa fa-times"></i> Selesai (Ditolak) </span>';
                    //         } else if (data.status == 2) {
                    //             return '<span class="badge badge-pill badge-lg light badge-success"><i class="fa fa-check"></i> Selesai (Diterima)</span>';
                    //         }
                    //     },
                    // },
                    {
                        data: null,
                        render: function(data, type, row) {
                            // if (data.status == 0) {
                            //     return (
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-success'  id='" +
                            //         data.id +
                            //         "' onClick='info_det(this.id)'><i class='fa fa-search'></i>" +
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-info'  id='" +
                            //         data.id +
                            //         "' onClick='info_edit(this.id)'><i class='fa fa-edit'></i>" +
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-danger'  id='" +
                            //         data.id +
                            //         "' onClick='info_hapus(this.id)'><i class='fa fa-trash'></i></button>&nbsp;"
                            //     );
                            // } else if (data.status == 1) {
                            //     return (
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-success'  id='" +
                            //         data.id +
                            //         "' onClick='info_det(this.id)'><i class='fa fa-search'></i>" +
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-danger'  id='" +
                            //         data.id +
                            //         "' onClick='info_hapus(this.id)'><i class='fa fa-trash'></i></button>&nbsp;"
                            //     );
                            // } else {
                            //     return (
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-success'  id='" +
                            //         data.id +
                            //         "' onClick='info_det(this.id)'><i class='fa fa-search'></i>"
                            //     );
                            // }
                            return (
                                "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-success'  id='" +
                                data.id +
                                "' onClick='info_det(this.id)'><i class='fa fa-search'></i>" +
                                "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-info'  id='" +
                                data.id +
                                "' onClick='info_edit(this.id)'><i class='fa fa-edit'></i>" +
                                "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-danger'  id='" +
                                data.id +
                                "' onClick='info_hapus(this.id)'><i class='fa fa-trash'></i></button>&nbsp;"
                            );
                        },
                    },
                ],
            });
        }

        function info_edit(clicked_id) {
            $("#modal_edit_cuti").modal("show");
            $(".edit_view").prop("disabled", false);
            $(".edit_view_eee").prop("disabled", true);
            $("#btn_foot").show(200);
            $("#file_view").hide(200);

            $.ajax({
                url: "{{ route('opd.get.cuti.det') }}",
                type: "get",
                data: {
                    id: clicked_id,
                },
                success: function(data) {
                    $("#e_id").val(data.data.id);
                    $("#e_nama").val(data.data.nama_pegawai);
                    $("#e_nip").val(data.data.nip);
                    $("#e_jabatan").val(data.data.jabatan);
                    $("#e_masa1").val(data.data.mk_thn);
                    $("#e_masa2").val(data.data.mk_bln);
                    $("#e_jenis_c").val(data.data.jenis_cuti).change();
                    $("#e_alasan_c").val(data.data.alasan);
                    $("#e_tgl_awal").val(data.data.tgl_awal);
                    $("#e_tgl_akhir").val(data.data.tgl_akhir);
                    $("#e_diff_hari").val(data.data.lama_c);
                    $("#e_jum_t").val(data.jum);
                    $("#e_sisa_t").val(12 - data.jum);
                    $("#e_catatan_c_t").val(data.data.catatan_c_t);
                    $("#e_catatan_c_b").val(data.data.catatan_c_b);
                    $("#e_catatan_c_s").val(data.data.catatan_c_s);
                    $("#e_catatan_c_m").val(data.data.catatan_c_m);
                    $("#e_catatan_c_ap").val(data.data.catatan_c_ap);
                    $("#e_catatan_c_cdlt").val(data.data.catatan_c_dlt);
                    $("#e_alamat_c").val(data.data.alamat);
                    $("#e_notelp_c").val(data.data.nomor_telp);
                },
                error: function(error) {
                    console.log(error);
                    error_detail(error);
                },
            });
        }

        function info_det(clicked_id) {
            $("#modal_edit_cuti").modal("show");
            $(".edit_view").prop("disabled", true);
            $(".edit_view_eee").prop("disabled", true);
            $("#btn_foot").hide(200);
            $("#file_view").show(200);

            $.ajax({
                url: "{{ route('opd.get.cuti.det') }}",
                type: "get",
                data: {
                    id: clicked_id,
                },
                success: function(data) {
                    $("#e_id").val(data.data.id);
                    $("#e_nama").val(data.data.nama_pegawai);
                    $("#e_nip").val(data.data.nip);
                    $("#e_jabatan").val(data.data.jabatan);
                    $("#e_masa1").val(data.data.mk_thn);
                    $("#e_masa2").val(data.data.mk_bln);
                    $("#e_jenis_c").val(data.data.jenis_cuti).change();
                    $("#e_alasan_c").val(data.data.alasan);
                    $("#e_tgl_awal").val(data.data.tgl_awal);
                    $("#e_tgl_akhir").val(data.data.tgl_akhir);
                    $("#e_diff_hari").val(data.data.lama_c);
                    $("#e_jum_t").val(data.jum);
                    $("#e_sisa_t").val(12 - data.jum);
                    $("#e_catatan_c_t").val(data.data.catatan_c_t);
                    $("#e_catatan_c_b").val(data.data.catatan_c_b);
                    $("#e_catatan_c_s").val(data.data.catatan_c_s);
                    $("#e_catatan_c_m").val(data.data.catatan_c_m);
                    $("#e_catatan_c_ap").val(data.data.catatan_c_ap);
                    $("#e_catatan_c_cdlt").val(data.data.catatan_c_dlt);
                    $("#e_alamat_c").val(data.data.alamat);
                    $("#e_notelp_c").val(data.data.nomor_telp);

                    $("#v_file_1").attr("src", "{{ url('/') }}/silacut/storage/app/public/" + data.data
                        .file_sk);
                    $("#v_file_2").attr("src", "{{ url('/') }}/silacut/storage/app/public/" + data.data
                        .file_absen);
                    $("#v_file_3").attr("src", "{{ url('/') }}/silacut/storage/app/public/" + data.data
                        .file_mohon);
                },
                error: function(error) {
                    console.log(error);
                    error_detail(error);
                },
            });
        }

        function info_hapus(clicked_id) {
            // alert(clicked_id);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger",
                },
                buttonsStyling: false,
            });

            swalWithBootstrapButtons
                .fire({
                    title: "Data akan dihapus?",
                    text: "Data dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus",
                    cancelButtonText: "Tidak, batalkan",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('opd.hapus.cuti') }}",
                            type: "get",
                            data: {
                                id: clicked_id,
                            },
                        });
                        loadData();
                        swalWithBootstrapButtons.fire(
                            "Terhapus!",
                            "Data Berhasil diHapus!.",
                            "success"
                        );
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire("Dibatalkan", "", "error");
                    }
                });
        }
    </script>
@endsection
