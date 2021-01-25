<?php

namespace App\Http\Controllers;

use App\Barang;
use App\PesananDetail;
use App\Pesanan;
use App\User;
use Auth;
use SweetAlert;
use Alert;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $barang = Barang::where('id',$id)->first();

        return view('pesan.index',compact('barang'));
    }

    public function pesan(Request $request, $id)
    {
        $barang = Barang::where('id',$id)->first();
        $tanggal = Carbon::now();
        //validasi pesanan harus kurang dari stok
        if($request->jumlah_pesan > $barang->stok)
        {
            return redirect('pesan/'.$id)->with('failed', 'Pesanan Anda Melebihi Stok');

        }

        //validasi pesanan
        $cek_pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();
        if(empty($cek_pesanan))
        {
            //simpan data base pesanan
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->kode = rand(100,999);
            $pesanan->jumlah_harga = 0;
            $pesanan->save();
        }
       

        //simpan data base pesanan detail
        $pesanan_baru = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();

        //cek pesanan detail jika barangnya sama maka tidak buat pesanan baru, tp tinggal tambah jumlah barang dan jumlah harga nya
        $cek_pesanan_detail = PesananDetail::where('barang_id',$barang->id)->where('pesanan_id',$pesanan_baru->id)->first();
        if(empty($cek_pesanan_detail))
        {
            $pesanan_detail = new PesananDetail;
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $barang->harga * $request->jumlah_pesan;
            $pesanan_detail->save();
        }else{
            $pesanan_detail = PesananDetail::where('barang_id',$barang->id)->where('pesanan_id',$pesanan_baru->id)->first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah + $request->jumlah_pesan;

            $harga_awal = $barang->harga * $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_awal;
            $pesanan_detail->update();
        }

        //jumlah total
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga + $barang->harga * $request->jumlah_pesan;
        $pesanan->update();


        Alert::success('Success Message', 'Optional Title');
        alert()->success('You have been logged out.', 'Good bye!');

        return redirect('home');
    }

    public function checkout()
    {
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();
        if(!empty($pesanan))
        {
            $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
            return view('pesan.checkout',compact('pesanan','pesanan_detail'));

        }else{
            $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();
            return view('pesan.checkout',compact('pesanan'));

        }
        return view('pesan.checkout',compact('pesanan','pesanan_detail'));

    }

    public function delete($id)
    {
        $pesanan_detail = PesananDetail::where('id',$id)->first();
        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga - $pesanan_detail->jumlah_harga;
        $pesanan->update();

        $pesanan_detail->delete();

        Alert::error('Success Delete', 'Delete');
        return redirect('checkout');
    }

    public function konfirmasi()
    {
        $user = User::where('id', Auth::user()->id)->first();
       
        if(empty($user->alamat))
        {
            Alert::error('Identitas harus lengkap', 'Alamat');
            return redirect('profil');
    
        }

        if(empty($user->no_hp))
        {
            Alert::error('Identitas harus lengkap', 'Alamat');
            return redirect('profil');
    
        }

        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_detail = PesananDetail::where('pesanan_id',$pesanan_id)->get();
        foreach ($pesanan_detail as $pd) {
            # code...
            $barang = Barang::where('id',$pd->barang_id)->first();
            $barang->stok = $barang->stok - $pd->jumlah;
            $barang->update();
        }

        Alert::error('Success checkout', 'checkout');
        return redirect('history/'.$pesanan_id)->with('success', 'Pesanan Anda Sedang Di proses');;    }
}
