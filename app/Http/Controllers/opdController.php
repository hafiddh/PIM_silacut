<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Validator;

class opdController extends Controller
{


    public function index()
    {
        $pegawai = DB::table('data_pegawai')->where('kode_opd', auth()->user()->id)->count();
        $cuti = DB::table('data_cuti')->leftjoin('data_pegawai', 'data_pegawai.id_pegawai', 'data_cuti.id_pegawai')->where('data_pegawai.kode_opd', auth()->user()->id)->count();
        return view('opd.index', [
            'pegawai'   => $pegawai,
            'cuti'      => $cuti
        ]);
    }

    public function data_cuti()
    {
        $data_pegawai = DB::table('data_pegawai')
            ->leftjoin('data_opd', 'data_pegawai.kode_opd', '=', 'data_opd.id_opd')
            ->where('data_pegawai.kode_opd', '=', auth()->user()->id)
            ->select('data_pegawai.id_pegawai', 'data_pegawai.nama_pegawai', 'data_pegawai.nip', 'data_opd.nama_opd')
            ->orderby('nama_pegawai', 'asc')
            ->get();

        return view('opd.input_data', [
            'pegawai' => $data_pegawai
        ]);
    }


    public function data_pegawai()
    {
        $opd =  DB::table('data_opd')->get();
        return view('opd.data_pegawai', [
            'opd' => $opd
        ]);
    }

    public function tambah_pegawai(Request $request)
    {
        DB::table('data_pegawai')
            ->where('id_pegawai', $request->id_peg)
            ->update([
                'kode_opd' => auth()->user()->id,
            ]);

        return \redirect(route('opd.pegawai'))->with('success', 'Data Pegawai berhasil ditambahkan!');
    }


    public function get_detail_pegawai(Request $request)
    {
        $data = DB::table('data_pegawai')->where('id_pegawai', $request->id)
            ->leftjoin('data_opd', 'data_pegawai.kode_opd', '=', 'data_opd.id_opd')
            ->select('data_pegawai.*', 'data_opd.nama_opd')->first();
        return response()->json($data);
    }

    public function get_opd_pegawai(Request $request)
    {
        $pegawai = DB::table('data_pegawai')
            ->leftJoin('data_opd', 'data_pegawai.kode_opd', '=', 'data_opd.id_opd')
            ->select('data_pegawai.id_pegawai', 'data_pegawai.nip', 'data_pegawai.nama_pegawai', 'data_opd.nama_opd')
            ->orderBy('data_pegawai.nama_pegawai', 'asc')
            ->where('data_pegawai.kode_opd', auth()->user()->id)
            ->get();

        return Datatables::of($pegawai)->make();
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

        return \redirect(route('opd.pegawai'))->with('success', 'Data Pegawai berhasil diedit!');
    }

    public function hapus_pegawai(Request $request)
    {
        DB::table('data_pegawai')
            ->where('id_pegawai', $request->id)
            ->update([
                'kode_opd' => NULL,
            ]);

        return response()->json();
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
            return response()->json(['pesan' => 'Input Kosong']);
        }
    }


    public function get_tot_cuti(Request $request)
    {
        $year = date("Y");
        $data = DB::table('data_cuti')
            ->whereYear('created_at', '=', $year)
            ->where('id_pegawai', $request->id)
            ->sum('lama_c');

        return response()->json($data);
    }


    public function tambah_cuti(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'file_sk' => 'required|max:2048|mimes:pdf',
            'file_absen' => 'required|max:2048|mimes:pdf',
            'file_permohonan' => 'required|max:2048|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return \redirect(route('opd.data.cuti'))->with('error', 'File harus berformat PDF dengan ukuran maksimal 2MB!!');
        }

        $extension = $request->file('file_sk')->getClientOriginalExtension();
        $sk_name = $request->id_pegawai . '_SK_' . date('YmdHi') . '.' . $extension;
        $absen_name = $request->id_pegawai . '_Absen_' . date('YmdHi') . '.' . $extension;
        $permohonan_name = $request->id_pegawai . '_Permohonan_' . date('YmdHi') . '.' . $extension;

        // dd($request->all());
        $file_sk = $request->file('file_sk');
        $file_sk->storeAs('public/', $sk_name);
        $file_sk = $request->file('file_absen');
        $file_sk->storeAs('public/', $absen_name);
        $file_sk = $request->file('file_permohonan');
        $file_sk->storeAs('public/', $permohonan_name);

        DB::table('data_cuti')->insert([
            'id_pegawai' => $request->id_pegawai,
            'jenis_cuti' => $request->jen_c,
            'alasan' => $request->alasan_c,
            'tgl_awal' => $request->tgl_aw_c,
            'tgl_akhir' => $request->tgl_ak_c,
            'lama_c' => $request->lama_c,
            'catatan_c_t' => $request->catatan_c_,
            'catatan_c_b' => $request->catatan_c_t,
            'catatan_c_s' => $request->catatan_c_s,
            'catatan_c_m' => $request->catatan_c_m,
            'catatan_c_ap' => $request->catatan_c_ap,
            'catatan_c_dlt' => $request->catatan_c_dlt,
            'alamat' => $request->alamat_c,
            'nomor_telp' => $request->nomor_telp_c,
            'status' => '0',
            'file_sk' => $sk_name,
            'file_absen' => $absen_name,
            'file_mohon' => $permohonan_name,
        ]);

        $tentang = "Data Cuti Baru";
        $isi = auth()->user()->name . "mengajukan usulan cuti. Masuk ke menu Data Cuti untuk melihat detail";
        DB::table('data_notifikasi')->insert([
            'tentang' => $tentang,
            'isi' => $isi,
            'id_opd' => '999',
            'status_baca' => '0',
        ]);

        return \redirect(route('opd.data.cuti'))->with('success', 'Data Cuti Diajukan!');
    }


    public function get_cuti(Request $request)
    {
        $data = DB::table('data_cuti')
            ->leftjoin('data_pegawai', 'data_pegawai.id_pegawai', '=', 'data_cuti.id_pegawai')
            ->where('data_pegawai.kode_opd', auth()->user()->id)
            ->orderby('data_cuti.created_at', 'desc')
            ->select('data_cuti.*', 'data_pegawai.nama_pegawai', 'data_pegawai.nip')
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

    public function hapus_cuti(Request $request)
    {
        DB::table('data_cuti')->where('id', $request->id)->delete();
        return response()->json();
    }


    public function notif_kill(Request $request)
    {
        $id = $request->input('id');
        $rev = DB::table('data_notifikasi')
            ->where('id_opd', $id)
            ->update(['status_baca' => "1"]);

        return $id;
    }



    //pegawai

    public function get_pegawai(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('data_pegawai')->where('nama_pegawai', 'LIKE', "%$cari%")->orWhere('nip_baru', 'LIKE', "%$cari%")->get();
            return response()->json($data);
        } else {
            return response()->json(['pesan' => 'Input Kosong']);
        }
    }
}
