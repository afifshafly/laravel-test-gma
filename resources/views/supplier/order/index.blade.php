@extends('layouts.app')

@section('content')
@include('layouts.headers.background')
<div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="row">
            <div class="col"><h1 class="text-white text-left">Order List</h1></div>
        </div>
        <div class="card">
          <table class="table table-bordered" id="tableProduk">
            <thead>
                <tr>
                   <th>Nomor Order</th>
                   <th>Toko</th>
                   <th>Nama Produk</th>
                   <th>Qty</th>
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
    @include('supplier.order.js')
@endpush

@include('supplier.order.modal')
@endsection
