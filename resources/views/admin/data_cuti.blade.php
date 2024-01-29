@extends('admin/temp_admin')
@section('judul', 'Data Cuti')
@section('side_kel', 'active')
@section('judul2', 'Data Cuti')

@section('tambah_css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/fixedHeader.dataTables.min.css') }}">

    <style>
        .modal {
            overflow: auto !important;
        }
    </style>
@endsection



@section('isi')
    <div class="row">
        <div class="col">
            <div class="card">
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
                                <th>Satuan Kerja</th>
                                {{-- <th style="width: 5%">Status</th> --}}
                                <th style="width: 5%">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit_cuti" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5e72e4">
                    <h5 class="modal-title" style="color: white;">Detail Cuti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style=" color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form_print" action="{{ route('admin.cetak.cuti') }}" class="d-inline">
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
                                <input class="form-control   edit_view_eee" id="e_nip" type="text" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Jabatan</label>
                            <div class="col-md-10">
                                <input class="form-control   edit_view_eee" id="e_jabatan" type="text" value="">
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

                        <hr style="border-top: 1px solid black;">

                        <input type="text" id="e_id_kop" name="id_kop" class="form-control" hidden>
                    </div>
                    <div class="modal-footer" style="margin-top: -50px" id="btn_foot">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" id="btn_print" class="btn btn-warning"><i class="fa fa-print"></i> Cetak
                            Surat Cuti
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_kop" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5e72e4">
                    <h5 class="modal-title" style="color: white;">Detail Cuti</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style=" color: white;" aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label col-sm-12 form-control-label">Pilih Kop Surat</label>
                        <div class="col-md-10">
                            <select id="id_kop" class="form-control select2">
                                <option value="#" selected disabled>- Pilih Kop Surat -</option>
                                <option value="1">KOP BUPATI</option>
                                <option value="2">KOP SEKDA</option>
                                <option value="3">KOP BKPSDMD</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="margin-top: -50px" id="btn_foot">
                    <button type="button" id="btn_print_c" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <button type="button" id="btn_print_real" class="btn btn-warning"><i class="fa fa-print"></i> Cetak
                        Surat Cuti
                    </button>
                </div>
            </div>
        </div>
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

            $(".select2").select2();

            $(".sudah_pilih").prop("disabled", true);
            $(".edit_view").prop("disabled", true);
        });

        $("#btn_print").click(() => {
            $("#modal_edit_cuti").modal("hide");
            $("#modal_kop").modal("show");
        });

        $("#btn_print_c").click(() => {
            $("#modal_kop").modal("hide");
            $("#modal_edit_cuti").modal("show");
        });

        $("#btn_print_real").click(() => {
            $("#form_print").submit();
        })

        $("#id_kop").on('change', function() {
            // alert(this.value);
            $("#e_id_kop").val(this.value);
        });


        function format(inputDate) {
            let date, month, year;

            date = inputDate.getDate();
            month = inputDate.getMonth() + 1;
            year = inputDate.getFullYear();

            date = date.toString().padStart(2, "0");

            month = month.toString().padStart(2, "0");

            return `${date}-${month}-${year}`;
        }

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
                    url: "{{ route('admin.get.all.cuti') }}",
                    type: "GET",
                },
                aoColumnDefs: [{
                        bSortable: false,
                        aTargets: [3, 4, 7, ],
                    },
                    {
                        bSearchable: false,
                        aTargets: [3, 4, 7, ],
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
                    {
                        data: "nama_opd",
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
                                "' onClick='info_det(this.id)'><i class='fa fa-search'></i>"
                            );
                        },
                    },
                ],
            });
        }

        function info_det(clicked_id) {
            $("#modal_edit_cuti").modal("show");
            $(".edit_view").prop("disabled", true);
            $(".edit_view_eee").prop("disabled", true);

            $.ajax({
                url: "{{ route('admin.get.cuti.det') }}",
                type: "get",
                data: {
                    id: clicked_id,
                },
                success: function(data) {
                    $("#e_id").val(data.data.id);
                    $("#e_unit").val(data.data.nama_opd);
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
    </script>
@endsection
