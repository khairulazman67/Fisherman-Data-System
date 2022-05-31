<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Nelayan;
use App\Models\Boat;
use App\Models\Tangkapan;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
    public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
	}
    
    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    function hari($hari){
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
            case 'Mon':			
                $hari_ini = "Senin";
            break;
            case 'Tue':
                $hari_ini = "Selasa";
            break;
            case 'Wed':
                $hari_ini = "Rabu";
            break;
            case 'Thu':
                $hari_ini = "Kamis";
            break;
            case 'Fri':
                $hari_ini = "Jumat";
            break;
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            default:
                $hari_ini = "Tidak di ketahui";		
            break;
        }
        return  $hari_ini ;
    }

    public function index(){
        
        $tanggal = null;
        $hari = null;
        $data = Tangkapan::orderBy('created_at','desc')->paginate(10);

        $jumlahnelayan = Nelayan::count();
        $jumlahboat = Boat::count();
        $jumlahtangkapan = Tangkapan::whereDate('created_at', date("Y-m-d"))->sum('banyak');

        $boat = Boat::get();
        // dd(date("Y-m-d"));
        $tanggal = $this->tgl_indo(date("Y-m-d"));
        $hari = $this->hari(date("D"));
        
        return view('beranda',['data'=>$data, 'jumlahtangkapan'=>$jumlahtangkapan,'jumlahboat'=>$jumlahboat,'tanggal'=>$tanggal,'hari'=>$hari, 'boat'=>$boat,'jumlahnelayan'=>$jumlahnelayan]);
    }
    public function datanelayan(){
        $tanggal = null;
        $hari = null;
        $data = Boat::orderBy('created_at','desc')->paginate(3);
        $boat = Boat::get();

        $nelayan = Nelayan::orderBy('nama','desc')->paginate(5);

        return view('data_nelayan',['data'=>$data, 'boat'=>$boat,'nelayan'=>$nelayan]);
    }
    public function tambahboat(Request $request){
        
        $request->validate(
            [
                'nama_boat' => 'required',
                'nama_pemilik' => 'required'
            ]
        );
        $cekdata = DB::table('boats')->where('nama', $request->nama_boat)->first();
        if($cekdata){
            return redirect('/datanelayan')->with('failed', 'Nama boat telah didaftarkan sebelumnya!!');
        }else{
            $boat = new Boat;
            $boat->nama = $request->nama_boat;
            $boat->pemilik = $request->nama_pemilik;
            $boat->save();

            if($boat){
                return redirect('/datanelayan')->with('successb', 'Data boat berhasil disimpan');
            }else{
                return redirect('/datanelayan')->with('failedb', 'Terjadi kesalahan saat menyimpan data boat');
            }
        }
    }
    public function hapusboat($data){
        $delete = DB::table('boats')->where('id','=',$data)->delete();
        if($delete){
            return redirect('/datanelayan')->with('successb', 'Data boat berhasil dihapus');
        }else{
            return redirect('/datanelayan')->with('failedb', 'Terjadi kesalahan saat menghapus data boat');
        }
    }
    public function editboat(Request $request){
        $request->validate(
            [
                'id' => 'required',
                'nama_boat' => 'required',
                'nama_pemilik' => 'required'
            ]
        );
        $boat = Boat::findOrfail($request->id);
        $boat->nama = $request->nama_boat;
        $boat->pemilik = $request->nama_pemilik;
        $boat->update();

        if($boat){
            return redirect('/datanelayan')->with('successb', 'Data boat berhasil diupdate');
        }else{
            return redirect('/datanelayan')->with('failedb', 'Terjadi kesalahan saat update data boat');
        }
    }

    //nelayan
    public function tambahdatanelayan(Request $request){
        // dd($request);
        $request->validate(
            // $request->all(),
            [
                'nama_nelayan' => 'required',
                'alamat' => 'required',
                'id_boat' => 'required',
                'no_hp' => 'required',
            ]
        );

        $nelayan = new Nelayan;
        // dd($nelayan);    
        $nelayan->nama = $request->nama_nelayan;
        $nelayan->alamat = $request->alamat;
        $nelayan->no_hp = $request->no_hp;
        $nelayan->id_boat = $request->id_boat;
        $nelayan->save();
        if($nelayan){
            return redirect('/datanelayan')->with('successn', 'Data nelayan berhasil ditambahkan');
        }else{
            return redirect('/datanelayan')->with('failedn', 'Terjadi kesalahan saat menambahkan data nelayan');
        }
        
        
    }
    public function hapusnelayan($id){
        $delete = DB::table('nelayans')->where('id','=',$id)->delete();
        if($delete){
            return redirect('/datanelayan')->with('successn', 'Data nelayan berhasil dihapus');
        }else{
            return redirect('/datanelayan')->with('failedn', 'Terjadi kesalahan saat menghapus data nelayan');
        }
    }

    public function editnelayan(Request $request,$id){
        // $nelayan = new Nelayan;
        
        if($request->nama_nelayan){
            $request->validate(
                [
                    'nama_nelayan' => 'required',
                    'alamat' => 'required',
                    'id_boat' => 'required',
                    'no_hp' => 'required',
                ]
            );
            // dd($request);
            $nelayan = Nelayan::findOrfail($id);
            $nelayan->nama = $request->nama_nelayan;
            $nelayan->alamat = $request->alamat;
            $nelayan->no_hp = $request->no_hp;
            $nelayan->id_boat = $request->id_boat;
            $nelayan->update();

            if($nelayan){
                return redirect('/datanelayan')->with('successn', 'Data nelayan berhasil diupdate');
            }else{
                return redirect('/datanelayan')->with('failedn', 'Terjadi kesalahan saat update data nelayan');
            }

        }else{
            $boat = Boat::get();
            $nelayan = Nelayan::findOrfail($id);
            return view('edit_nelayan',['nelayan'=>$nelayan,'boat'=>$boat]);
        }
    }
    public function tambahtangkapan(Request $request){
        $request->validate(
            [
                'id_boat' => 'required',
                'tangkapan' => 'required',
                'jumlah' => 'required',
            ]
        );
        $tangkapan = new Tangkapan;
        $tangkapan->id_boat = $request->id_boat;
        $tangkapan->jenis_ikan = $request->tangkapan;
        $tangkapan->banyak = $request->jumlah;
        $tangkapan->save();
        if($tangkapan){
            return redirect('/')->with('success', 'Data tangkapan berhasil ditambahkan');
        }else{
            return redirect('/')->with('failed', 'Terjadi kesalahan saat ditamah data tangkapan');
        }
        // dd($request);
    }
    public function hapustangkapan($id){
        $delete = DB::table('tangkapans')->where('id','=',$id)->delete();
        if($delete){
            return redirect('/')->with('success', 'Data tangkapan berhasil dihapus');
        }else{
            return redirect('/')->with('failed', 'Terjadi kesalahan saat menghapus data tangkapan');
        }
    }
    public function edittangkapan(Request $request){
        // dd(Tangkapan::findOrfail($request->$id));    
        $request->validate(
            [
                'id' => 'required',
                'id_boat' => 'required',
                'tangkapan' => 'required',
                'jumlah_ikan' => 'required',
            ]
        );
        $tangkapan = Tangkapan::findOrfail($request->id);
        $tangkapan->id_boat = $request->id_boat;
        $tangkapan->jenis_ikan = $request->tangkapan;
        $tangkapan->banyak = $request->jumlah_ikan;
        $tangkapan->update();
        if($tangkapan){
            return redirect('/')->with('success', 'Data tangkapan berhasil diupdate');
        }else{
            return redirect('/')->with('failed', 'Terjadi kesalahan saat update data tangkapan');
        }

    }

    public function laporan(){
        $tangkapan = Tangkapan::get();

        $tangkapan = Tangkapan::orderBy('id_boat','desc')->get();
        return view('laporan',['tangkapan'=>$tangkapan]);
    }
}
