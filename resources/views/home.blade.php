@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12 mb-4">
        <img src="{{url ('images/logo.png')}}" class="rounded mx-auto d-block" width="700" alt="">
    </div>

    @foreach($barangs as $barang)
        <div class="col-md-4">
            <div class="card" style="width: 18rem">
                <img src="{{ url('uploads')}}/{{$barang->gambar}}" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{$barang->nama_barang}}</h5>
                    <p class="card-text">
                    <strong>Harga : Rp. {{ number_format($barang->harga)}}</strong> <br>
                    <strong>Stok : {{ $barang->stok}}</strong> <br>
                    <hr>
                    <strong>{{$barang->keterangan}}</strong>
                    </p>
                    <a href="{{url('pesan/'.$barang->id)}}" class="btn btn-primary"> Beli </a>
                </div>
            </div>
        </div>
    @endforeach
        
    </div>
</div>
@endsection
