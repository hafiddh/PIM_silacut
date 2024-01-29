<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use DataTables;
use Hash;
use PDF;

class AdminController extends Controller
{

    public function index()
    {
        $pegawai = DB::table('data_pegawai')->count();
        $cuti = DB::table('data_cuti')->leftjoin('data_pegawai', 'data_pegawai.id_pegawai', 'data_cuti.id_pegawai')->count();
        return view('admin.index', [
            'pegawai'   => $pegawai,
            'cuti'      => $cuti
        ]);
    }


    public function data_pegawai()
    {
        $opd =  DB::table('data_opd')->get();
        return view('admin.data_pegawai', [
            'opd' => $opd
        ]);
    }

    public function get_data(Request $request)
    {
        $pegawai = DB::table('data_pegawai')
            ->leftJoin('data_opd', 'data_pegawai.kode_opd', '=', 'data_opd.id_opd')
            ->select('data_pegawai.id_pegawai', 'data_pegawai.nip', 'data_pegawai.nama_pegawai', 'data_opd.nama_opd')
            ->orderBy('data_opd.nama_opd', 'desc')
            ->get();

        return Datatables::of($pegawai)->make();
    }

    public function get_detail_pegawai(Request $request)
    {
        $data = DB::table('data_pegawai')->where('id_pegawai', $request->id)->first();
        return response()->json($data);
    }


    public function tambah_pegawai(Request $request)
    {
        // dd($request);
        DB::table('data_pegawai')->insert([
            'nama_pegawai' => $request->nama,
            'nip' => $request->nip,
            'lahir_tempat' => $request->tempat,
            'lahir_tgl' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jk,
            'mk_thn' => $request->masa1,
            'mk_bln' => $request->masa2,
            'jabatan' => $request->jabatan,
            'kode_opd' => $request->opd,
        ]);

        return \redirect(route('admin.pegawai'))->with('success', 'Data Pegawai ditambahkan!');
    }


    public function edit_pegawai(Request $request)
    {
        DB::table('data_pegawai')
            ->where('id_pegawai', $request->id)
            ->update([
                'nama_pegawai' => $request->nama,
                'nip' => $request->nip,
                'lahir_tempat' => $request->tempat,
                'lahir_tgl' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jk,
                'mk_thn' => $request->masa1,
                'mk_bln' => $request->masa2,
                'jabatan' => $request->jabatan,
                'kode_opd' => $request->opd,
            ]);

        return \redirect(route('admin.pegawai'))->with('success', 'Data Pegawai diedit!');
    }

    public function hapus_pegawai(Request $request)
    {
        DB::table('data_pegawai')->where('id_pegawai', $request->id)->delete();
        return response()->json();
    }


    //OPD
    public function data_opd()
    {
        return view('admin.data_opd');
    }

    public function get_all_opd(Request $request)
    {
        $pegawai = DB::table('data_opd')
            ->get();

        return Datatables::of($pegawai)->make();
    }

    public function get_detail_opd(Request $request)
    {
        $data = DB::table('data_opd')->where('id_opd', $request->id)->first();
        return response()->json($data);
    }


    public function tambah_opd(Request $request)
    {
        // dd($request);
        DB::table('data_opd')->insert([
            'nama_opd' => $request->nama,
        ]);

        return \redirect(route('admin.opd'))->with('success', 'Data OPD ditambahkan!');
    }


    public function edit_opd(Request $request)
    {
        DB::table('data_opd')
            ->where('id_opd', $request->id)
            ->update([
                'nama_opd' => $request->nama,
            ]);

        return \redirect(route('admin.opd'))->with('success', 'Data OPD diedit!');
    }

    public function hapus_opd(Request $request)
    {
        DB::table('data_opd')->where('id_opd', $request->id)->delete();
        return response()->json();
    }


    //PENGGUNA
    public function data_pengguna()
    {
        $opd =  DB::table('data_opd')->get();
        return view('admin.data_pengguna', [
            'opd' => $opd
        ]);
    }

    public function get_all_pengguna(Request $request)
    {
        $pegawai = DB::table('users')
            ->select('id', 'username', 'name')
            ->where('level', '1')
            ->get();

        return Datatables::of($pegawai)->make();
    }

    public function get_detail_pengguna(Request $request)
    {
        $data = DB::table('users')
            ->where('id', $request->id)
            ->select('id', 'username', 'name')
            ->first();
        return response()->json($data);
    }


    public function tambah_pengguna(Request $request)
    {
        $cek = DB::table('users')->where('id', $request->opd)->count();
        if ($cek > 0) {
            return \redirect(route('admin.pengguna'))->with('error', 'Data Pengguna untuk OPD ini sudah ada!');
        }
        $nama = DB::table('data_opd')->where('id_opd', $request->opd)->first();
        $password = Hash::make($request->password);
        DB::table('users')->insert([
            'id' => $request->opd,
            'username' => $request->username,
            'name' => $nama->nama_opd,
            'password' => $password,
            'level' => '1',
        ]);

        return \redirect(route('admin.pengguna'))->with('success', 'Data Pengguna ditambahkan!');
    }


    public function edit_pengguna(Request $request)
    {
        $password = Hash::make($request->password);
        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'password' => $password
            ]);

        return \redirect(route('admin.pengguna'))->with('success', 'Password pengguna berhasil diubah!');
    }

    public function hapus_pengguna(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        return response()->json();
    }


    public function data_cuti()
    {
        return view('admin.data_cuti');
    }

    public function get_all_cuti(Request $request)
    {
        $data = DB::table('data_cuti')
            ->leftjoin('data_pegawai', 'data_pegawai.id_pegawai', '=', 'data_cuti.id_pegawai')
            ->leftjoin('data_opd', 'data_pegawai.kode_opd', '=', 'data_opd.id_opd')
            ->orderby('data_cuti.created_at', 'desc')
            ->select('data_cuti.*', 'data_opd.nama_opd', 'data_pegawai.nama_pegawai', 'data_pegawai.nip')
            ->get();

        return Datatables::of($data)->make();
    }

    public function get_peg_cuti(Request $request)
    {
        $data = DB::table('data_cuti')
            ->where('data_cuti.id_pegawai', $request->id)
            ->leftjoin('data_pegawai', 'data_pegawai.id_pegawai', '=', 'data_cuti.id_pegawai')
            ->leftjoin('data_opd', 'data_pegawai.kode_opd', '=', 'data_opd.id_opd')
            ->orderby('data_cuti.created_at', 'asc')
            ->select('data_cuti.*', 'data_opd.nama_opd', 'data_pegawai.nama_pegawai', 'data_pegawai.nip')
            ->get();

        return Datatables::of($data)->make();
    }

    public function get_cuti_det(Request $request)
    {
        $data = DB::table('data_cuti')->where('id', $request->id)
            ->leftjoin('data_pegawai', 'data_pegawai.id_pegawai', '=', 'data_cuti.id_pegawai')
            ->leftjoin('data_opd', 'data_pegawai.kode_opd', '=', 'data_opd.id_opd')
            ->select('data_cuti.*', 'data_pegawai.mk_thn', 'data_pegawai.mk_bln', 'data_pegawai.jabatan', 'data_pegawai.nip', 'data_pegawai.nama_pegawai', 'data_opd.nama_opd')->first();

        $year = date("Y");
        $jum = DB::table('data_cuti')
            ->whereYear('created_at', '=', $year)
            ->where('id_pegawai', $data->id_pegawai)
            ->sum('lama_c');
        return response()->json([
            'data' => $data,
            'jum'   => $jum
        ]);
    }


    public function cetak_surat_cuti(Request $request)
    {
        // dd($request->all());
        $data_cuti = DB::table('data_cuti')->where('id', $request->e_id)->first();
        $data_pegawai = DB::table('data_pegawai')->where('id_pegawai', $data_cuti->id_pegawai)->first();
        $data_opd = DB::table('data_opd')->where('id_opd', $data_pegawai->kode_opd)->first();
        $jenis_cuti = $data_cuti->jenis_cuti;
        if ($jenis_cuti == 1) {
            $jenis = "Cuti Tahunan";
        } else if ($jenis_cuti == 2) {
            $jenis = "Cuti Besar";
        } else if ($jenis_cuti == 3) {
            $jenis = "Cuti Sakit";
        } else if ($jenis_cuti == 4) {
            $jenis = "Cuti Melahirkan";
        } else if ($jenis_cuti == 5) {
            $jenis = "Cuti Alasan Penting";
        } else if ($jenis_cuti == 6) {
            $jenis = "Cuti di Luar Tanggungan Negara";
        }
        $id_kop = $request->id_kop;
        // dd($data_cuti, $data_pegawai, $data_opd);

        $pdf = PDF::loadview('admin.print', [
            'data_cuti' => $data_cuti,
            'data_pegawai' => $data_pegawai,
            'data_opd' => $data_opd,
            'jenis_cuti' => $jenis,
            'id_kop' => $id_kop,
        ]);
        $judul = $data_pegawai->nama_pegawai . " - Surat Cuti Pegawai";
        return $pdf->download($judul);
    }


    public function rekap_data_cuti()
    {
        return view('admin.rekap_data_cuti');
    }

    public function select_pegawai_opd(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('data_pegawai')
                ->where('nama_pegawai', 'LIKE', "%$cari%")
                ->orWhere('nip', 'LIKE', "%$cari%")
                ->get();
            return response()->json($data);
        } else {
            return response()->json([]);
        }
    }

    public function notif_kill(Request $request)
    {
        // dd($request->id);

        DB::table('data_notifikasi')
            ->where('id', $request->id)
            ->update(['status_baca' => "1"]);

        return \redirect(route('admin.cuti'));
    }

    public function data_masuk()
    {

        $rekon_data = DB::table('rekon_id')
            ->leftJoin('data_opd', 'rekon_id.kode_opd', '=', 'data_opd.id_opd')
            ->select('bulan', 'tahun', 'id', 'waktu_up', 'data_opd.nama_opd AS opd', 'status_rev')
            ->where('status_rev', '1')
            ->orderBy('waktu_up', 'desc')
            ->get();

        return view('admin/data_masuk', ['data' => $rekon_data]);
    }

    public function validasi_rekon(Request $request)
    {

        // dd('lol');
        $id = $request->id;

        // dd($id);
        $data_rekon = DB::table('rekon_id')
            ->where('id', '=', $request->id)
            ->leftJoin('data_opd', 'rekon_id.kode_opd', '=', 'data_opd.id_opd')
            ->first();

        $bulan = $data_rekon->bulan;
        $tahun = $data_rekon->tahun;
        $tahun_num = $tahun;
        if ($bulan == 'Januari') {
            $tahun_num = $tahun - 1;
            $bulan_num = 'Desember';
        } else if ($bulan == 'Februari') {
            $bulan_num = 'Januari';
        } else if ($bulan == 'Maret') {
            $bulan_num = 'Februari';
        } else if ($bulan == 'April') {
            $bulan_num = 'Maret';
        } else if ($bulan == 'Mei') {
            $bulan_num = 'April';
        } else if ($bulan == 'Juni') {
            $bulan_num = 'Mei';
        } else if ($bulan == 'Juli') {
            $bulan_num = 'Juni';
        } else if ($bulan == 'Agustus') {
            $bulan_num = 'Juli';
        } else if ($bulan == 'September') {
            $bulan_num = 'Agustus';
        } else if ($bulan == 'Oktober') {
            $bulan_num = 'September';
        } else if ($bulan == 'November') {
            $bulan_num = 'Oktober';
        } else if ($bulan == 'Desember') {
            $bulan_num = 'November';
        }

        $data_pegawai = DB::table('data_pegawai')
            ->select('nama_pegawai', 'nip_baru')
            ->get();

        $detail_pegawai =  DB::table('rekon_data')
            ->leftJoin('data_pegawai', 'rekon_data.nip', '=', 'data_pegawai.nip_baru')
            ->leftjoin('data_keluarga', 'data_keluarga.nip_pegawai', '=', 'data_pegawai.nip_baru')
            ->where('rekon_data.id_rekon', $request->id)
            ->get();


        //VALIDASI

        $rekon_old = DB::table('rekon_id')
            ->where('kode_opd', '=', $data_rekon->id_opd)
            ->where('bulan', '=', $bulan_num)
            ->where('tahun', '=', $tahun_num)
            ->first();
        // dd($bulan_num, $tahun_num);


        $data_rekon_old =  DB::table('rekon_data')
            ->leftJoin('data_pegawai', 'rekon_data.nip', '=', 'data_pegawai.nip_baru')
            ->where('rekon_data.id_rekon', $rekon_old->id)
            ->get();

        $det_valid = DB::select('select T2.* from rekon_data as T2 where id_rekon = ? and not exists (select * from rekon_data as T1 where id_rekon = ? AND T1.nip = T2.nip)', [$data_rekon->id, $rekon_old->id]);

        $det_valid2 = DB::select('select T2.* from rekon_data as T2 where id_rekon = ? and not exists (select * from rekon_data as T1 where id_rekon = ? AND T1.nip = T2.nip)', [$rekon_old->id, $data_rekon->id]);

        // if($det_valid != null){
        //     dd('1');
        // }else{
        //     dd('2');
        // }
        // $det_pindah = DB::table('pegawai_opd')
        //                     ->leftJoin('data_pegawai', 'pegawai_opd.id_pegawai', '=', 'data_pegawai.id_pegawai')
        //                     ->where('data_pegawai.nip_baru', $det_valid[0]->nip)
        //                     ->orderBy('tgl', 'desc')
        //                     ->first();
        foreach ($det_valid as $lol) {
            DB::table('rekon_data')
                ->where('nip', $lol->nip)
                ->update(['stat' => '1']);
        }

        return view('admin/detail_masuk', ['id' => $id, 'data' => $data_rekon, 'detail_pegawai' => $detail_pegawai, 'pegawai' => $data_pegawai, 'det_valid' => $det_valid, 'det_valid2' => $det_valid2]);
    }


    public function rekon_tolak(Request $request)
    {
        $id = $request->id;
        $text = $request->t_revisi;

        // dd($id, $text);
        DB::table('rekon_id')
            ->where('id', $id)
            ->update([
                'status_rev' => '3',
                'keterangan_rev' => $text
            ]);

        $rekon = DB::table('rekon_id')
            ->where('id', $id)->get();

        $bulan = $rekon[0]->bulan;
        $tahun = $rekon[0]->tahun;
        $kode_opd =  $rekon[0]->kode_opd;

        $text = "Data Rekon bulan $bulan tahun $tahun ditolak, silakan periksa kembali!";
        $nootif = DB::insert(
            'INSERT INTO data_notifikasi (tentang, isi, id_opd, status_baca) VALUES (?,?,?,?);',
            ['Data Rekon ditolak', $text,  $kode_opd, '0']
        );

        $request->session()->put('kon', '0');
        $request->session()->put('status', 'Data dikembalikan untuk diubah!');
        return redirect()->route('admin.data.masuk');
    }


    public function rekon_valid(Request $request)
    {

        $id = $request->id;



        // dd($id);
        DB::table('rekon_id')
            ->where('id', $id)
            ->update(['status_rev' => '2']);

        $rekon = DB::table('rekon_id')
            ->where('id', $id)->get();

        $opd = DB::table('data_opd')
            ->where('id_opd', '=', $rekon[0]->kode_opd)
            ->select('nama_opd')
            ->get();

        $rekon = DB::table('rekon_id')
            ->where('id', $id)->get();

        $bulan = $rekon[0]->bulan;
        $tahun = $rekon[0]->tahun;
        $kode_opd =  $rekon[0]->kode_opd;
        $opd2 = $opd[0]->nama_opd;

        $text = "Data Rekon OPD $opd2 bulan $bulan tahun $tahun sudah divalidasi. ";
        $nootif = DB::insert(
            'INSERT INTO data_notifikasi (tentang, isi, id_opd, status_baca) VALUES (?,?,?,?);',
            [$opd2, $text,  '101', '0']
        );

        $text3 = "DATA REKON TERVALIDASI";
        $text2 = "Data Rekon bulan $bulan tahun $tahun sudah divalidasi. Terima kasih telah melakukan rekon data.";
        $nootif = DB::insert(
            'INSERT INTO data_notifikasi (tentang, isi, id_opd, status_baca) VALUES (?,?,?,?);',
            [$text3, $text2,  $kode_opd, '0']
        );

        $request->session()->put('kon', '0');
        $request->session()->put('status', 'Data diteruskan ke Keuangan!');
        return redirect()->route('admin.data.terkirim');
    }


    public function data_terkirim()
    {

        $rekon_data = DB::table('rekon_id')
            ->leftJoin('data_opd', 'rekon_id.kode_opd', '=', 'data_opd.id_opd')
            ->select('bulan', 'tahun', 'id', 'waktu_up', 'data_opd.nama_opd AS opd', 'status_rev')
            ->where('status_rev', '2')
            ->orderBy('waktu_up', 'desc')
            ->get();

        return view('admin/data_valid', ['data' => $rekon_data]);
    }


    public function detail_valid(Request $request)
    {

        $id = $request->id;

        // dd($id);
        $data_rekon = DB::table('rekon_id')
            ->where('id', '=', $request->id)
            ->leftJoin('data_opd', 'rekon_id.kode_opd', '=', 'data_opd.id_opd')
            ->get();

        $data_pegawai = DB::table('data_pegawai')
            ->select('nama_pegawai', 'nip_baru')
            ->get();

        $detail_pegawai =  DB::table('rekon_data')
            ->leftJoin('data_pegawai', 'rekon_data.nip', '=', 'data_pegawai.nip_baru')
            ->leftjoin('data_keluarga', 'data_keluarga.nip_pegawai', '=', 'data_pegawai.nip_baru')
            ->where('rekon_data.id_rekon', $request->id)
            ->get();

        // dd($data_rekon);
        return view('admin/detail_valid', ['id' => $id, 'data' => $data_rekon, 'detail_pegawai' => $detail_pegawai, 'pegawai' => $data_pegawai]);
    }



    public function getClientIps()
    {
        $clientIP = \Request::getClientIp(true);
        dd($clientIP);
    }
}
