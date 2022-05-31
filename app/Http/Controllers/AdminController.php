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
        $data = Nelayan::orderBy('created_at','desc')->paginate(10);
        $jumlah = count($data);
        if($jumlah>0){
            $tanggal = $this->tgl_indo($data[0]->created_at->format('Y-m-d'));
            $hari = $this->hari($data[0]->created_at->format('D'));
        }
        return view('beranda',['data'=>$data, 'jumlah'=>$jumlah,'tanggal'=>$tanggal,'hari'=>$hari]);
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
        
        $val = Validator::make(
            $request->all(),
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
        $val = Validator::make(
            $request->all(),
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
        $val = Validator::make(
            $request->all(),
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
        $val = Validator::make(
            $request->all(),
            [
                'nama_nelayan' => 'required',
                'alamat' => 'required',
                'id_boat' => 'required',
                'no_hp' => 'required',
            ]
        );
        if($request->nama_nelayan){
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
            // $boat= DB::table('boats')->where('id','=',$id)->first();
            $nelayan = Nelayan::findOrfail($id);
            return view('edit_nelayan',['nelayan'=>$nelayan,'boat'=>$boat]);
            // dd($nelayan);
        }
        
    }
}
