@extends('admin.temp_admin')
@section('judul', 'Rekap Data Cuti')
@section('side_rek', 'active')
@section('judul2', 'Rekap Data Cuti')

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
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label form-control-label">Pilih Pegawai</label>
                        <div class="col-md-10">
                            <select id="select_pegawai" name="id_peg" class="form-control"></select>
                        </div>
                    </div>
                </div>
                <div id="hideen" class="table-responsive py-4">
                    <table class="table table-flush" id="datatable33">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Nama Pegawai</th>
                                <th>NIP</th>
                                <th>Jenis Cuti</th>
                                <th>Tanggal Cuti</th>
                                <th>Diajukan</th>
                                <th>Satuan Kerja</th>
                                <th>Hak Cuti</th>
                                <th>Jumlah Hari</th>
                                <th>Sisa Cuti</th>
                            </tr>
                        </thead>
                    </table>
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
            $(".select2").select2();
            $("#hideen").hide();

            $(".sudah_pilih").prop("disabled", true);
            $(".edit_view").prop("disabled", true);

            $('#select_pegawai').select2({
                placeholder: 'Cari berdasarkan NIP ...',
                ajax: {
                    url: "{{ route('admin.select.pegawai') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {

                        return {
                            results: $.map(data, function(item) {
                                $("#lol").val(item.id_pegawai);

                                return {
                                    text: '' + item.nama_pegawai + ' (' + item.nip + ')',
                                    id: item.id_pegawai
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });

        $("#btn_ini").click(function() {
            var id = $("select_pegawai").text();
            console.log(id);
        });


        $('#select_pegawai').change(() => {
            var id = $('#select_pegawai').val();
            loadData(id);
            $("#hideen").show(200);
        })

        function format(inputDate) {
            let date, month, year;

            date = inputDate.getDate();
            month = inputDate.getMonth() + 1;
            year = inputDate.getFullYear();

            date = date.toString().padStart(2, "0");

            month = month.toString().padStart(2, "0");

            return `${date}-${month}-${year}`;
        }

        function loadData(id) {
            var kuo = 12;
            var out = 0;
            $("#datatable33").DataTable({
                paging: false,
                destroy: true,
                info: false,
                searching: false,
                autoWidth: false,
                processing: true,
                serverSide: true,
                "ordering": false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'print',
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '14pt')
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }],
                ajax: {
                    url: "{{ route('admin.get.cuti.peg') }}",
                    type: "get",
                    data: {
                        id: id,
                    },
                },
                columns: [{
                        data: null,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: "nama_pegawai",
                    },
                    {
                        data: "nip",
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
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (data.jenis_cuti == 1) {
                                kuo = kuo - data.lama_c;
                                out = parseInt(kuo) + parseInt(data.lama_c);
                                // console.log(parseInt(kuo) + parseInt(data.lama_c));
                                return (out);
                            } else {
                                return "-";
                            }
                        },
                    },
                    {
                        data: "lama_c",
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (data.jenis_cuti == 1) {
                                return (out - data.lama_c);
                            } else {
                                return "-";
                            }
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
                    $("#v_file_1").attr("src", "{{ url('/') }}{{ Storage::url('') }}" + data.data
                        .file_sk);
                    $("#v_file_2").attr("src", "{{ url('/') }}{{ Storage::url('') }}" + data.data
                        .file_absen);
                    $("#v_file_3").attr("src", "{{ url('/') }}{{ Storage::url('') }}" + data.data
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
