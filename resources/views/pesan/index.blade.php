@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{url('home')}}" class="btn btn-warning">Back</a>
        </div>
        <div class="col-md-6 mb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item " ><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
               
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        <img src="{{ url('uploads/'.$barang->gambar)}}" class="rounded mx-auto d-block" width="100%" class="card-img-top" alt="">

                        </div>
                        
                        <div class="col-md-6 mt-5">
                            <h2><b><i>{{ $barang->nama_barang}}</i></b></h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>Rp. {{number_format($barang->harga)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>:</td>
                                        <td>{{$barang->stok}}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{$barang->keterangan}}</td>                                    </tr>
                                    </tr>  

                                            <tr>
                                                <td>Jumlah</td>
                                                <td>:</td>
                                                <td>
                                                    <form action="{{ url('pesan/'.$barang->id)}}" method="post">
                                                        @csrf
                                                        <input type="text" name="jumlah_pesan" class="form-control mb-1" required="">
                                                       

                                                        @if ($message = Session::get('failed'))
                                                            <div class="alert alert-danger alert-dismissible">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                <h5> Alert!</h5>
                                                                {{ $message }}
                                                            </div>
                                                        @endif
                                                        <button type="submit" class="btn btn-success mt-1"> Masukan Keranjang </button>
                                                    </form>
                                                </td>
                                            </tr>
                                           
                                     
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
@endsection
