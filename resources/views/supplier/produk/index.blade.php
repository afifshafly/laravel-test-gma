@extends('layouts.app')

@section('content')
@include('layouts.headers.background')

<div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="row">
            <div class="col"><h1 class="text-white text-left">Produk</h1></div>
            <div class="col d-flex flex-row-reverse"><button class="btn btn-success mb-2 ml-auto" id="tambahProduk">Tambah Produk</button></div>
        </div>
        <div class="card">
          <table class="table table-bordered" id="tableProduk">
            <thead>
                <tr>
                   <th>Nama Produk</th>
                   <th>Stock</th>
                   <th>Action</th>
                </tr>
            </thead>

            <tbody>
            </tbody>

          </table>
        </div>
      </div>
    </div>
    @include('layouts.footers.footer')
</div>


@push('js')
    @include('supplier.produk.js')
@endpush

@include('supplier.produk.modal')
@endsection
