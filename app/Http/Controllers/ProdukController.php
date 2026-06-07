<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $pro = Produk::all();
        return view('layout.produk', ['produks' => $pro,'text'=>'produk']);
    }

    public function Tambahproduk()
    {
        return view('layout.tambahproduk',['text'=>'produk']);
    }

    public function Tambahkankedb(Request $request)
    {
        Produk::create([
            'kode_produk' => $request->kodeproduk,
            'nama_produk' => $request->namaproduk,
        ]);
        return redirect()->intended('/produk');
    }

    public function Editproduk($id)
    {
        $pro = Produk::find($id);
        return view('layout.editproduk', ['data' => $pro,'text'=>'produk']);
    }
    public function Updatedata(Request $request)
    {
        $pro = Produk::findOrFail($request->id);
        $pro->kode_produk = $request->kodeproduk;
        $pro->nama_produk = $request->namaproduk;
        $pro->save();

        return redirect()->intended('/produk');
    }
    public function hapusdataproduk($id)
    {
        Produk::destroy($id);
        return redirect()->intended('/produk');
    }




}
