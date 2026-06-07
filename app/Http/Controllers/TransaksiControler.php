<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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



    // bagian itemset
    public function itemSet()
    {
        // pembentukkan 2 item set
        $alltransaksi = Transaksi::all();
        $combinations = [];
        foreach ($alltransaksi as $trans) {
            $array = Str::of($trans->kode_transaksi)->explode(',');
            $length = count($array);
            for ($i = 0; $i < $length; $i++) {
                for ($j = $i + 1; $j < $length; $j++) {
                    $combinations[] = [$array[$i], $array[$j]];
                }
            }
        }

        dump($combinations);
        // end pembentukan item set
       


        // bagian untuk cek kesamaan array
        $array1 = ['apple', 'banana', 'cherry'];
        $array2 = ['banana', 'cherry', 'apple']; // Urutan berbeda

        // Mencari selisih bolak-balik untuk memastikan benar-benar sama
        $diff1 = collect($array1)->diff($array2);
        $diff2 = collect($array2)->diff($array1);

        $isSameContent = $diff1->isEmpty() && $diff2->isEmpty();

        dump($isSameContent); // Hasil: true

        // end cek kesamaan isi array
    }
}
