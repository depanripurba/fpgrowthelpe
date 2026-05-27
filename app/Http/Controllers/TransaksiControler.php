<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiControler extends Controller
{
    
    public function index()
    {
        $trans = Transaksi::all();
        return view('layout.transaksi', ['transaksi' => $trans]);
    }

    public function Tambahtransaksi()
    {
        return view('layout.tambahtransaksi');
    }

    public function Tambahkankedb(Request $request)
    {
        Transaksi::create([
            'tanggal_transaksi' => $request->tanggaltransaksi,
            'kode_transaksi' => $request->kodetransaksi,
        ]);
        return redirect()->intended('/transaksi');
    }

    public function Edittransaksi($id)
    {
        $trans = Transaksi::find($id);
        return view('layout.edittransaksi', ['data' => $trans]);
    }
    public function Updatedata(Request $request)
    {
        $trans = Transaksi::findOrFail($request->id);
        $trans->tanggal_transaksi = $request->tanggaltransaksi;
        $trans->kode_transaksi = $request->kodetransaksi;
        $trans->save();

        return redirect()->intended('/transaksi');
    }
    public function hapusdatatransaksi($id)
    {
        Transaksi::destroy($id);
        return redirect()->intended('/transaksi');
    }

}




