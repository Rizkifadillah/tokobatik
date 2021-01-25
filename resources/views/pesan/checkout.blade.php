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
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3><i>Checkout</i></h3>
                @if(!empty($pesanan))
                    <h6 align="right">Tanngal Pesan : {{ date('D-M-Y',strtotime($pesanan->tanggal)) }}</h6>
                    
                </div>
                
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Action</th>                            
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
                                <td>
                                    <form action="{{ url('checkout/'.$pd->id)}}" method="post">
                                    @csrf
                                    {{ method_field('DELETE')}}
                                        <div style="width:60px">
                                            <!-- <a href="{{ url('checkout')}}" id-supplier="'.$id.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> -->
                                            <button  type="submit" class="btn btn-danger btn-hapus btn-sm" onclick="return confirm('Anda yakin akan menghapus data?');" id="delete"><i class="fa fa-trash-o"></i>Delete</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td align="center" colspan="4"><b><i>Total Harga</i></b></td>
                            <td>Rp. {{number_format($pesanan -> jumlah_harga)}}</td>
                            <td>
                               
                                <a href="{{ url('konfirmasi-checkout')}}" class="btn btn-success btn-sm" onclick="return confirm('Anda yakin akan Checkout?');"><i class="fa fa-pencil-square-o"></i>Checkout</a>
                                            
                            </td>
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
