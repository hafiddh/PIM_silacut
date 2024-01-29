<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\opdController;

Route::get('/', function () {
        return view('welcome');
})->name('login');

Route::get('/home', function () {
        return view('welcome');
})->name('login');

Route::get('/login', function () {
        return view('welcome');
})->name('login');

Route::get('/up_data', function () {
        return view('up');
});
Route::post('/up', 'Con_upload_data@store');

Route::post('/login', 'LoginController@login')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');

//bkd
Route::group(['middleware' => ['auth', 'ceklevel:3']], function () {

        Route::get('/admin', 'AdminController@index');

        Route::get('/admin/data_pegawai', 'AdminController@data_pegawai')->name('admin.pegawai');
        Route::get('/admin/edit_pegawai/', 'AdminController@edit_pegawai');
        Route::get('/admin/data_pegawai/get_data', 'AdminController@get_data');

        Route::get('/admin/get-detail-pegawai', 'AdminController@get_detail_pegawai')->name('admin.get.pegawai');
        Route::post('/admin/tambah-pegawai', 'AdminController@tambah_pegawai')->name('admin.tambah.pegawai');
        Route::post('/admin/edit-pegawai', 'AdminController@edit_pegawai')->name('admin.edit.pegawai');
        Route::get('/admin/hapus-pegawai', 'AdminController@hapus_pegawai')->name('admin.hapus.pegawai');

        Route::get('/admin/opd', 'AdminController@data_opd')->name('admin.opd');
        Route::post('/admin/tambah_opd', 'AdminController@tambah_opd')->name('admin.tambah.opd');
        Route::post('/admin/edit_opd', 'AdminController@edit_opd')->name('admin.edit.opd');
        Route::delete('/admin/hapus_opd', 'AdminController@hapus_opd')->name('admin.hapus.opd');
        Route::get('/admin/get_all_opd', 'AdminController@get_all_opd')->name('admin.get.all.opd');;
        Route::get('/admin/get_detail_opd', 'AdminController@get_detail_opd')->name('admin.get.det.opd');

        Route::get('/admin/pengguna', 'AdminController@data_pengguna')->name('admin.pengguna');
        Route::post('/admin/tambah_pengguna', 'AdminController@tambah_pengguna')->name('admin.tambah.pengguna');
        Route::post('/admin/edit_pengguna', 'AdminController@edit_pengguna')->name('admin.edit.pengguna');
        Route::delete('/admin/hapus_pengguna', 'AdminController@hapus_pengguna')->name('admin.hapus.pengguna');
        Route::get('/admin/get_all_pengguna', 'AdminController@get_all_pengguna')->name('admin.get.all.pengguna');;
        Route::get('/admin/get_detail_pengguna', 'AdminController@get_detail_pengguna')->name('admin.get.det.pengguna');


        //Data Cuti

        Route::get('/admin/data-cuti', 'AdminController@data_cuti')->name('admin.cuti');
        Route::post('/admin/tambah_cuti', 'AdminController@tambah_cuti')->name('admin.tambah.cuti');
        Route::post('/admin/edit_cuti', 'AdminController@edit_cuti')->name('admin.edit.cuti');
        Route::delete('/admin/hapus_cuti', 'AdminController@hapus_cuti')->name('admin.hapus.cuti');
        Route::get('/admin/get_all_cuti', 'AdminController@get_all_cuti')->name('admin.get.all.cuti');
        Route::get('/admin/get_detail_cuti', 'AdminController@get_cuti_det')->name('admin.get.cuti.det');

        Route::get('/admin/rekap-data-cuti', 'AdminController@rekap_data_cuti')->name('admin.rekap.cuti');

        Route::post('/admin/cetak-surat-cuti', 'AdminController@cetak_surat_cuti')->name('admin.cetak.cuti');
        Route::get('/admin/select_pegawai_opd', 'AdminController@select_pegawai_opd')->name('admin.select.pegawai');
        Route::get('/admin/get_peg_cuti', 'AdminController@get_peg_cuti')->name('admin.get.cuti.peg');

        Route::get('/admin/data_terkirim', 'AdminController@data_terkirim')->name('admin.data.terkirim');
        Route::get('/admin/detail_valid/{id}', 'AdminController@detail_valid');

        Route::get('/admin/data_masuk', 'AdminController@data_masuk')->name('admin.data.masuk');
        Route::get('/admin/validasi_rekon/{id}', 'AdminController@validasi_rekon');

        Route::post('/admin/rekon_tolak', 'AdminController@rekon_tolak');
        Route::post('/admin/rekon_valid', 'AdminController@rekon_valid');

        Route::get('/admin/kill_notif/{id}', 'AdminController@notif_kill');
        Route::get('/admin/ip/', 'AdminController@getClientIps');
});

//opd
Route::group(['middleware' => ['auth', 'ceklevel:1']], function () {

        Route::get('/opd', 'opdController@index')->name('opd.index');
        Route::get('/opd/data-cuti', 'opdController@data_cuti')->name('opd.data.cuti');

        Route::get('/opd/data_pegawai', 'opdController@data_pegawai')->name('opd.pegawai');
        Route::post('/opd/tambah_pegawai', 'opdController@tambah_pegawai')->name('opd.tambah.pegawai');
        Route::get('/opd/get-detail-pegawai', 'opdController@get_detail_pegawai')->name('opd.get.pegawai');
        Route::get('/opd/get-opd-pegawai', 'opdController@get_opd_pegawai');
        Route::post('/opd/edit-pegawai', 'opdController@edit_pegawai')->name('opd.edit.pegawai');
        Route::get('/opd/hapus-pegawai', 'opdController@hapus_pegawai')->name('opd.hapus.pegawai');

        Route::get('/opd/select_pegawai_opd', 'opdController@select_pegawai_opd')->name('opd.select.pegawai');

        Route::get('/opd/pegawai-tot-cuti', 'opdController@get_tot_cuti')->name('opd.get.pegawai.cuti');

        Route::post('/opd/tambah_cuti', 'opdController@tambah_cuti')->name('opd.tambah.cuti');
        Route::post('/opd/edit_cuti', 'opdController@edit_cuti')->name('opd.edit.cuti');
        Route::get('/opd/get_cuti', 'opdController@get_cuti')->name('opd.get.cuti');
        Route::get('/opd/get_cuti_det', 'opdController@get_cuti_det')->name('opd.get.cuti.det');
        Route::get('/opd/hapus-cuti', 'opdController@hapus_cuti')->name('opd.hapus.cuti');


        
        Route::put('/opd/up_pegawai', 'opdController@updatePegawai')->name('pegawai.up');
        // Route::get('/opd/input_data', function () {
        //         return view('opd/data_input');
        // });

        // Route::get('/opd/detail', function () {
        //         return view('opd/detail_input');
        // });

        // Route::get('/opd/detail_revisi', function () {
        //         return view('opd/detail_revisi');
        // });


        // Route::get('/opd/detail_terkirim', function () {
        //         return view('opd/detail_terkirim');
        // });


        Route::get('/opd/input_data', 'opdController@input_data')->name('opd.input.rekon');
        Route::get('/opd/lihat_data', 'opdController@lihat_data_rekon')->name('opd.lihat.rekon');



        Route::get('/opd/id_pegawai/{id}', 'opdController@data_pegawai_id');

        Route::get('/opd/data_revisi', 'opdController@data_revisi');
        Route::get('/opd/get_pegawai', 'opdController@get_pegawai');
        Route::get('/opd/get_pegawai_opd', 'opdController@get_pegawai_opd');

        Route::post('/opd/input_data/edit_rekon/{id}/tambah_pegawai', 'opdController@edit_rekon_tambah');
        Route::get('/opd/input_data/edit_rekon/{id}', 'opdController@edit_rekon');


        Route::get('/opd/data_terkirim', 'opdController@data_verifikasi');
        Route::get('/opd/ambil_detail_valid/{id}', 'opdController@ambil_detail_valid');

        Route::post('/opd/input_rekon', 'opdController@input_rekon');

        Route::get('/opd/data_revisi_det', 'opdController@data_revisi');
        Route::post('/opd/data_revisi_det', 'opdController@data_revisi_det');
        Route::post('/opd/buat_data', 'opdController@buat_data');
        Route::get('/opd/kill_notif', 'opdController@notif_kill');

        Route::delete('/opd/input_data/edit_rekon/hapus_rekon/{id}', 'opdController@delete_detail_rekon');
        Route::delete('/opd/input_data/hapus_rekon/{id}', 'opdController@delete_rekon');
});
