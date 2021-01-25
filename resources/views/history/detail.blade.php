@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{url('history')}}" class="btn btn-warning">Back</a>
        </div>
        <div class="col-md-6 mb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item " ><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item " ><a href="{{url('history')}}">History</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3><i>Sukses Checkout</i></h3>
                    <h5><i>Pesanan anda sudah sukses di checkout, selanjutnya pembayaran silahkan transfer di rekening <b>Bank Bri: 221-4432-4432221</b> dengan nominal <b>Rp. {{number_format($pesanan -> jumlah_harga + $pesanan -> kode)}}</b></i></h5>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><i>Detail Pemesanan</i></h3>
                @if(!empty($pesanan))
                    <h6 align="right">Tanngal Pesan : {{ date('D-M-Y',strtotime($pesanan->tanggal)) }}</h6>
                    
                </div>
                
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($pesanan_detail as $pd)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $pd->barang->nama_barang}}</td>
                                <td>{{ $pd->jumlah}} kain</td>
                                <td>Rp. {{ number_format($pd->barang->harga)}}</td>
                                <td>Rp. {{ number_format($pd->jumlah_harga)}}</td>

                            </tr>
                        @endforeach
                        <tr>
                            <td align="right" colspan="4"><b><i>Total Harga :</i></b></td>
                            <td>Rp. {{number_format($pesanan -> jumlah_harga)}}</td>
                            
                        </tr>
                        <tr>
                            <td align="right" colspan="4"><b><i>Kode Unik :</i></b></td>
                            <td>Rp. {{number_format($pesanan -> kode)}}</td>
                            
                        </tr>
                        <tr>
                            <td align="right" colspan="4"><b><i>Total yang harus ditransfer :</i></b></td>
                            <td>Rp. {{number_format($pesanan -> jumlah_harga + $pesanan -> kode)}}</td>
                            
                        </tr>
                        </tbody>
                    </table>
                @else
                <h4 align="center"><i>Sedang kami proses pesanan anda</i></h4>
               

                @endif
                </div>
            </div>
        </div>
       
   </div>
</div>
@endsection
