@extends('layouts.app')

@section('content')
@include('layouts.headers.background')
<div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <button class="btn btn-success mb-2" id="tambahProduk">Tambah Produk</button>
        <div class="card">
          <table class="table table-bordered">
            <thead>
                <tr>
                   <th>Nama Produk</th>
                   <th>Stock</th>
                   <th width="200px">Action</th>
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
