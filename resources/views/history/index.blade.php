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
                    <li class="breadcrumb-item active" aria-current="page">History</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Kode Pembayaran</th>
                                <th>Jumlah Harga</th>
                                <th>Action</th>
                            </tr> 
                        </thead>
                        <tbody>
                        @foreach($pesanan as $pesan)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $pesan->tanggal}}</td>
                                <td>
                                    @if($pesan->status == 1)
                                    Sudah pesan & belum dibayar
                                    @else
                                    Sudah dibayar
                                    @endif
                                </td>
                                <td>{{$pesan->kode}}</td>
                                <td>Rp. {{ number_format($pesan->jumlah_harga)}}</td>
                                <td>
                                    <a href="{{ url('history/'.$pesan->id)}}"  class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i> Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                       
                    </table>
               
                </div>
            </div>

           

        </div>
       
   </div>
</div>
@endsection
