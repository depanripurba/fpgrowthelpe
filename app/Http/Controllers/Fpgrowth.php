<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\VarDumper;

class Fpgrowth extends Controller
{

    private function getfrekuensiproduk()
    {
        $pro = Produk::all();
        $trans = Transaksi::all();
        $totaltrans = Transaksi::count();

        $transaksi = [];
        foreach ($trans as $tr) {
            $array = Str::of($tr->kode_transaksi)->explode(',');
            $transaksi[] = $array;
        }
        // end ubah transaksi jadi array
        $kirimdata = [];
        foreach ($pro as $p) {
            $itemcount = 0;
            $nomor = 0;
            foreach ($transaksi as $cek) {
                foreach ($cek as $k) {
                    if ($k === $p->kode_produk) {
                        $itemcount++;
                    }
                }
            }
            $part = [
                'no' => $nomor,
                'frekuensi' => $itemcount,
                'support' => round(($itemcount / $totaltrans) * 100, 3),
                'kode_produk' => $p->kode_produk,
                'nama_produk' => $p->nama_produk

            ];
            $kirimdata[] = $part;
        }
        return json_decode(json_encode($kirimdata));
    }
    public function index()
    {
        $totaltrans = Transaksi::count();
        return view('layout.frekuensiitemset', ['produks' => $this->getfrekuensiproduk(), 'text' => 'fpg', 'totaltransaksi' => $totaltrans]);
    }

    // fungsi untuk hitung nilai support

    private function Itemset()
    {
        $pro = Produk::all();
        $trans = Transaksi::all();
        $totaltrans = Transaksi::count();

        $transaksi = [];
        foreach ($trans as $tr) {
            $array = Str::of($tr->kode_transaksi)->explode(',');
            $transaksi[] = $array;
        }
        // end ubah transaksi jadi array
        $kirimdata = [];
        foreach ($pro as $p) {
            $itemcount = 0;
            $nomor = 0;
            foreach ($transaksi as $cek) {
                foreach ($cek as $k) {
                    if ($k === $p->kode_produk) {
                        $itemcount++;
                    }
                }
            }

            $kirimdata[$p->kode_produk] = round(($itemcount / $totaltrans) * 100, 3);
        }
        return $kirimdata;
    }

    private function eliminasi()
    {
        $data = $this->itemSet();;
        $trans = Transaksi::all();
        // dtrb = data transaksi baru
        $dtrb = [];
        foreach ($trans as $d) {
            $array = Str::of($d->kode_transaksi)->explode(',');
            $arraybaru = [];

            foreach ($array as $arr) {
                if ($data[$arr] >= 10) {
                    $arraybaru[$arr] = $data[$arr];
                }
            }

            $sortedDesc = collect($arraybaru)->sortDesc()->all();
            $string = "";
            $parr = count($arraybaru);

            $keys = array_keys($sortedDesc);

            for ($i = 0; $i < $parr; $i++) {

                if ($i === $parr - 1) {
                    $string .= $keys[$i];
                } else {
                    $string .= $keys[$i] . ",";
                }
            }
            $colbar = [
                "kode_transaksi" => $string,
                "tanggal" => $d->tanggal_transaksi,

            ];

            $dtrb[] = $colbar;
        }
        return $dtrb;
    }


    private function hitungnilaisuport()
    {
        $kumpulan_pasangan = [];
        $hasildata = $this->eliminasi();
        foreach ($hasildata as $hasil) {
            $array = Str::of($hasil['kode_transaksi'])->explode(',');
            $parray = count($array);
            if ($parray > 1) {
                for ($i = 0; $i < $parray; $i++) {
                    // $j selalu mulai dari depan $i ($i + 1) agar tidak berpasangan dengan diri sendiri
                    for ($j = $i + 1; $j < $parray; $j++) {

                        // Memasukkan array isi 2 elemen ke dalam wadah
                        $kumpulan_pasangan[] = [
                            $array[$i],
                            $array[$j]
                        ];
                    }
                }
            }
        }

        // bagian hitung jumlah array yang sama
        $hitung_kombinasi = [];

        foreach ($kumpulan_pasangan as $item) {
            // 2. Gabungkan menjadi string (misal: "AM,BI") untuk dijadikan KEY penghitung
            $key_kombinasi = implode(',', $item);

            // 3. Hitung kemunculannya
            if (!isset($hitung_kombinasi[$key_kombinasi])) {
                $hitung_kombinasi[$key_kombinasi] = 1;
            } else {
                $hitung_kombinasi[$key_kombinasi]++;
            }
        }

        // 4. Filter hanya untuk menampilkan yang muncul lebih dari 1 kali (duplikat)
        $duplikat = array_filter($hitung_kombinasi, function ($jumlah) {
            return $jumlah > 0;
        });


        // var_dump($kumpulan_pasangan);
        ksort($duplikat);
        $data_objek = json_decode(json_encode($duplikat));
        return $data_objek;
    }
    public function lanjutan()
    {

        $dtrb = $this->eliminasi();
        return view('layout.tlanjutan', ['transaksi' => $dtrb, 'text' => 'lanjutan']);
    }

    // end fungsi hitung nilai suport


    // start function dua item
    public function Duaitem()
    {
        $totaltrans = Transaksi::count();
        $duplikat = $this->hitungnilaisuport();
        // Tampilkan hasil pasangan yang kembar beserta jumlahnya
        // var_dump($data_objek);
        // end bagian hitung array yang sama
        return view('layout.duaitem', ['transaksi' => $duplikat, 'total_transaksi' => $totaltrans, 'text' => 'duaitem']);
    }
    // end fucntion dua item


    // start eliminasi nilai dibawah 6
    private function eliminasisuport()
    {
        $totaltrans = Transaksi::count();
        $sumber = $this->hitungnilaisuport();
        $temp = [];
        foreach ($sumber as $sum => $val) {

            $nilais = $val / $totaltrans * 100;
            if ($nilais < 6) {
            } else {
                $temp[$sum] = $nilais;
            }
        }
        arsort($temp);
        $data_objek = json_decode(json_encode($temp));
        return $data_objek;
    }
    // end eliminasi nilai dibawah 6

    // start function minimum support
    public function minimumsuport()
    {
        $totaltrans = Transaksi::count();
        return view('layout.minimumsuport', ['transaksi' => $this->eliminasisuport(), 'totaltransaksi' => $totaltrans, 'text' => 'minimum']);
    }
    // end function minimum support
    private function ambilnilaiconfidence()
    {
        $sumber = $this->eliminasisuport();
        $frekuensi = $this->getfrekuensiproduk();
        $data_array = (array) $frekuensi;
        $frekuensitoar = [];
        foreach ($data_array as $da => $v) {
            $frekuensitoar[$v->kode_produk] = $v->frekuensi;
        }
        $tempat = [];
        foreach ($sumber as $s => $val) {
            $array = Str::of($s)->explode(',');
            $tempat[] = [
                "kode_produk" => $s,
                "frekuensitr" => $val * Transaksi::count() / 100,
                "frekuensipro" => $frekuensitoar[$array[0]],
                "confidence" => number_format($val / $frekuensitoar[$array[0]] * Transaksi::count(), 2)
            ];
            $str = $array[1] . "," . $array[0];
            $tempat[] = [
                "kode_produk" => $str,
                "frekuensitr" => $val * Transaksi::count() / 100,
                "frekuensipro" => $frekuensitoar[$array[1]],
                "confidence" => number_format($val / $frekuensitoar[$array[1]] * Transaksi::count(), 2)
            ];
        }

        return $tempat;
    }
    // start function confidence
    public function nilaiconfidence()
    {
        $data = $this->ambilnilaiconfidence();
        return view('layout.confidence', ['transaksi' => $data, 'totaltransaksi' => Transaksi::count(), 'text' => 'confidence']);
    }

    public function eliminasiconfidence()
    {
        $getdata = $this->ambilnilaiconfidence();
        $databaru = [];
        foreach ($getdata as $d) {
            if ($d['confidence'] < 50) {
            } else {
                $databaru[] = [
                    'kode_produk' => $d['kode_produk'],
                    'frekuensitr' => $d['frekuensitr'],
                    'frekuensipro' => $d['frekuensipro'],
                    'confidence' => $d['confidence'],
                ];
            }
        }
        usort($databaru, function ($a, $b) {
            // Mengubah string ke float, lalu membandingkan $b dengan $a untuk descending
            return (float)$b['confidence'] <=> (float)$a['confidence'];
        });
        return view('layout.elconfidence', ['transaksi' => $databaru, 'totaltransaksi' => Transaksi::count(), 'text' => 'elconfidence']);
    }
    // end function confidence







}
