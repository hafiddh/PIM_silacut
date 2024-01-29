<!-- =========================================================
* Argon Dashboard PRO v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2019 Creative Tim (https://www.creative-tim.com)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>@yield('judul')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    <!-- Page plugins -->
    @yield('tambah_css')
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('css/argon.css?v=1.1.0') }}" type="text/css">

    <style>
        .modal123 {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(255, 255, 255, .8) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat;
        }

        /* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
        body.loading .modal123 {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
   modal element will be visible */
        body.loading .modal123 {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <img src="{{ asset('login_res/img/blue.png') }}"  class="navbar-brand-img" alt="...">
                </a>
                <div class="ml-auto">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link @yield('side_dash')" href="{{ url('admin') }}">
                                <i class="ni ni-shop text-primary"></i>
                                <span class="nav-link-text">Dashboards</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @yield('side_kel')" href="{{ route('admin.cuti') }}">
                                <i class="ni ni-single-copy-04 text-info"></i>
                                <span class="nav-link-text">Data Cuti</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('side_rek')" href="{{ route('admin.rekap.cuti') }}">
                                <i class="ni ni-ungroup text-warning"></i>
                                <span class="nav-link-text">Rekapan Cuti</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @yield('side_asn')" href="#navbar-forms-2" data-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="navbar-forms-2">
                                <i class="ni ni-bullet-list-67 text-danger"></i>
                                <span class="nav-link-text">Komponen</span>
                            </a>
                            <div class="collapse @yield('side_asn2')" id="navbar-forms-2">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/opd') }}" class="nav-link @yield('side_opd')"><i
                                                class="ni ni-building text-warning"></i> Kelola OPD</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/data_pegawai') }}"
                                            class="nav-link @yield('side_pegawai')"><i
                                                class="ni ni-single-02 text-warning"></i> Kelola Pegawai</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/pengguna') }}" class="nav-link @yield('side_pengguna')"><i
                                                class="ni ni-circle-08 text-warning"></i> Kelola Pengguna</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted"></h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ asset('') }}uploads/buku_panduan_admin.pdf" target="_blank">
                                <i class="ni ni-ui-04"></i>
                                <span class="nav-link-text">Petunjuk Penggunaan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Search form -->

                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center ml-md-auto">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show"
                                data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li>
                        @php
                            $notif = DB::table('data_notifikasi')
                                ->where('id_opd', '=', auth()->user()->id)
                                ->where('status_baca', '=', '0')
                                ->orderBy('id', 'DESC')
                                ->get();
                            
                            // dd($notif);
                            $notif1 = DB::table('data_notifikasi')
                                ->where('id_opd', '=', auth()->user()->id)
                                ->where('status_baca', '=', '0')
                                ->count();
                            
                            // dd($notif);
                            
                        @endphp

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                @if ($notif1 == '0')
                                    <i class='ni ni-bell-55 pr-2'></i>
                                @else
                                    <i class='ni ni-bell-55 pr-2'></i><span
                                        class='badge badge-pill badge-warning'>{{ $notif1 }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                                <div class="px-3 py-3">
                                    @if ($notif1 == '0')
                                        <h6 class='text-sm text-muted m-0'>Tidak terdapat <strong
                                                class='text-primary'></strong>
                                            notifikasi baru.</h6>
                                    @else
                                        <h6 class='text-sm text-muted m-0'>Terdapat <strong
                                                class='text-primary'>{{ $notif1 }}</strong>
                                            notifikasi baru.</h6>
                                    @endif

                                </div>
                                <!-- List group -->
                                @foreach ($notif as $notif)
                                    <div id="notif" class="list-group list-group-flush">
                                        <a href="{{ url('admin/kill_notif/' . $notif->id) }}"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h4 class="mb-0 text-sm">{{ $notif->tentang }}</h4>
                                                        </div>
                                                    </div>
                                                    <p class="text-sm mb-0">{{ $notif->isi }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        {{-- <li class="nav-item dropdown">
                          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
                              <i class="ni ni-ungroup"></i>
                          </a>
                          <div
                              class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
                              <div class="row shortcuts px-4">
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                          <i class="ni ni-calendar-grid-58"></i>
                                      </span>
                                      <small>Calendar</small>
                                  </a>
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                          <i class="ni ni-email-83"></i>
                                      </span>
                                      <small>Email</small>
                                  </a>
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                          <i class="ni ni-credit-card"></i>
                                      </span>
                                      <small>Payments</small>
                                  </a>
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                          <i class="ni ni-books"></i>
                                      </span>
                                      <small>Reports</small>
                                  </a>
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                                          <i class="ni ni-pin-3"></i>
                                      </span>
                                      <small>Maps</small>
                                  </a>
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                                          <i class="ni ni-basket"></i>
                                      </span>
                                      <small>Shop</small>
                                  </a>
                              </div>
                          </div>
                      </li> --}}
                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="{{ asset('img/theme/team-4.jpg') }}">
                                    </span>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">

                                <a href="{{ url('/logout') }}" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">@yield('judul2')</h6>
                        </div>
                    </div>
                    @yield('index_head')

                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            @yield('isi')
            <!-- Footer -->
            <footer class="footer pt-0" style="margin-top: 100px;">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6">
                        <div class="copyright text-center text-lg-left text-muted">
                            &copy; 2022 <a href="http://bkpsdmd.morowalikab.go.id/" class="font-weight-bold ml-1"
                                target="_blank">BKPSDMD</a>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </footer>
        </div>
    </div>
    <div class="modal123">
        <!-- Place at bottom of page -->
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Optional JS -->

    @if (session()->has('error'))
        <script>
            $(document).ready(function() {
                new swal({
                    title: "ERROR!",
                    text: "{{ session()->get('error') }}",
                    icon: "error",
                    button: "Ok!",
                });
            });
        </script>
    @elseif(session()->has('success'))
        <script>
            $(document).ready(function() {
                new swal({
                    title: "Berhasil!",
                    text: "{{ session()->get('success') }}",
                    icon: "success",
                    button: "Ok!",
                });
            });
        </script>
    @elseif(session()->has('message'))
        <script>
            $(document).ready(function() {
                new swal({
                    title: "Pesan!",
                    text: "{{ session()->get('message') }}",
                    icon: "warning",
                    button: "Ok!",
                });
            });
        </script>
    @endif

    @yield('tambah_js')

    <script>
        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "loadingRecords": "Sedang memuat...",
                "processing": "Sedang memproses...",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "thousands": "'",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": ">>",
                    "previous": "<<"
                },
                "aria": {
                    "sortAscending": ": aktifkan untuk mengurutkan kolom ke atas",
                    "sortDescending": ": aktifkan untuk mengurutkan kolom menurun"
                },
                "autoFill": {
                    "cancel": "Batalkan",
                    "fill": "Isi semua sel dengan <i>%d<\/i>",
                    "fillHorizontal": "Isi sel secara horizontal",
                    "fillVertical": "Isi sel secara vertikal"
                },
                "buttons": {
                    "collection": "Kumpulan <span class='ui-button-icon-primary ui-icon ui-icon-triangle-1-s'\/>",
                    "colvis": "Visibilitas Kolom",
                    "colvisRestore": "Kembalikan visibilitas",
                    "copy": "Salin",
                    "copySuccess": {
                        "1": "1 baris disalin ke papan klip",
                        "_": "%d baris disalin ke papan klip"
                    },
                    "copyTitle": "Salin ke Papan klip",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Tampilkan semua baris",
                        "1": "Tampilkan 1 baris",
                        "_": "Tampilkan %d baris"
                    },
                    "pdf": "PDF",
                    "print": "Cetak",
                    "copyKeys": "Tekan ctrl atau u2318 + C untuk menyalin tabel ke papan klip.<br \/><br \/>Untuk membatalkan, klik pesan ini atau tekan esc."
                },
                "searchBuilder": {
                    "add": "Tambah Kondisi",
                    "button": {
                        "0": "Cari Builder",
                        "_": "Cari Builder (%d)"
                    },
                    "clearAll": "Bersihkan Semua",
                    "condition": "Kondisi",
                    "data": "Data",
                    "deleteTitle": "Hapus filter",
                    "leftTitle": "Ke Kiri",
                    "logicAnd": "Dan",
                    "logicOr": "Atau",
                    "rightTitle": "Ke Kanan",
                    "title": {
                        "0": "Cari Builder",
                        "_": "Cari Builder (%d)"
                    },
                    "value": "Nilai",
                    "conditions": {
                        "date": {
                            "after": "Setelah",
                            "before": "Sebelum",
                            "between": "Diantara",
                            "empty": "Kosong",
                            "equals": "Sama dengan",
                            "not": "Tidak sama",
                            "notBetween": "Tidak diantara",
                            "notEmpty": "Tidak kosong"
                        },
                        "number": {
                            "between": "Diantara",
                            "empty": "Kosong",
                            "equals": "Sama dengan",
                            "gt": "Lebih besar dari",
                            "gte": "Lebih besar atau sama dengan",
                            "lt": "Lebih kecil dari",
                            "lte": "Lebih kecil atau sama dengan",
                            "not": "Tidak sama",
                            "notBetween": "Tidak diantara",
                            "notEmpty": "Tidak kosong"
                        },
                        "string": {
                            "contains": "Berisi",
                            "empty": "Kosong",
                            "endsWith": "Diakhiri dengan",
                            "equals": "Sama Dengan",
                            "not": "Tidak sama",
                            "notEmpty": "Tidak kosong",
                            "startsWith": "Diawali dengan"
                        },
                        "array": {
                            "equals": "Sama dengan",
                            "empty": "Kosong",
                            "contains": "Berisi",
                            "not": "Tidak",
                            "notEmpty": "Tidak kosong",
                            "without": "Tanpa"
                        }
                    }
                },
                "searchPanes": {
                    "clearMessage": "Bersihkan Semua",
                    "count": "{total}",
                    "countFiltered": "{shown} ({total})",
                    "title": "Filter Aktif - %d",
                    "collapse": {
                        "0": "Panel Pencarian",
                        "_": "Panel Pencarian (%d)"
                    },
                    "emptyPanes": "Tidak Ada Panel Pencarian",
                    "loadMessage": "Memuat Panel Pencarian"
                },
                "infoThousands": ",",
                "searchPlaceholder": "Masukkan kata kunci yang dicari",
                "select": {
                    "1": "%d baris terpilih",
                    "_": "%d baris terpilih",
                    "cells": {
                        "1": "1 sel terpilih",
                        "_": "%d sel terpilih"
                    },
                    "columns": {
                        "1": "1 kolom terpilih",
                        "_": "%d kolom terpilih"
                    }
                },
                "datetime": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya",
                    "hours": "Jam",
                    "minutes": "Menit",
                    "seconds": "Detik",
                    "unknown": "-",
                    "amPm": [
                        "am",
                        "pm"
                    ]
                },
                "editor": {
                    "close": "Tutup",
                    "create": {
                        "button": "Tambah",
                        "submit": "Tambah",
                        "title": "Tambah inputan baru"
                    },
                    "remove": {
                        "button": "Hapus",
                        "submit": "Hapus",
                        "confirm": {
                            "_": "Apakah Anda yakin untuk menghapus %d baris?",
                            "1": "Apakah Anda yakin untuk menghapus 1 baris?"
                        },
                        "title": "Hapus inputan"
                    },
                    "multi": {
                        "title": "Beberapa Nilai",
                        "info": "Item yang dipilih berisi nilai yang berbeda untuk input ini. Untuk mengedit dan mengatur semua item untuk input ini ke nilai yang sama, klik atau tekan di sini, jika tidak maka akan mempertahankan nilai masing-masing.",
                        "restore": "Batalkan Perubahan",
                        "noMulti": "Masukan ini dapat diubah satu per satu, tetapi bukan bagian dari grup."
                    },
                    "edit": {
                        "title": "Edit inputan",
                        "submit": "Edit",
                        "button": "Edit"
                    },
                    "error": {
                        "system": "Terjadi kesalahan pada system. (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Informasi Selebihnya<\/a>)."
                    }
                }
            }
        });
    </script>

    <script src="{{ asset('vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/dist/Chart.extension.js') }}"></script>
    <!-- Argon JS -->
    <script src="{{ asset('js/argon.js?v=1.1.0') }}"></script>

    <script>
        $body = $("body");

        $(document).on({
            ajaxStart: function() {
                $body.addClass("loading");
            },
            ajaxStop: function() {
                $body.removeClass("loading");
            }
        });
    </script>

</body>

</html>
