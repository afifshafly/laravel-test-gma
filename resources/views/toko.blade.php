@extends('layouts.app')

@section('content')
@include('layouts.headers.background')
<div class="container-fluid mt--6">
    <div class="row ">
        <div class="col">
             <div class="row">
                <div class="col"><h1 class="text-white text-left">Toko Role</h1></div>
            </div>
            <div class="card">
                <div class="card-header">Selamat Datang di Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Gunakan Postman jika ingin menggunakan fitur pada role Toko') }}
                    <br>
                    <p>berikut ini adalah list endpoint untuk fitur toko</p>
                    <ul>
                        <h3 class="mb-0">Api Public</h3>
                        <li>http://localhost:8000/Api/Register (untuk melakukan registrasi)</li>
                        <ul>
                            <h4>kolom input</h4>
                            <li>name</li>
                            <li>email</li>
                            <li>password</li>
                            <li>confirm password</li>
                        </ul>
                        <li>http://localhost:8000/Api/login (untuk Login)</li>
                        <ul>
                            <h4>kolom input</h4>
                            <li>name</li>
                            <li>email</li>
                        </ul>
                        <li>http://localhost:8000/Api/password/forgot-password (untuk lupa password)</li>
                        <li>http://localhost:8000/Api/password/reset (untuk konfirmasi password)</li>
                        <ul>
                            <h4>kolom input</h4>
                            <li>email</li>
                            <li>token</li>
                            <li>password</li>
                            <li>confirm password</li>
                        </ul>
                        <li>http://localhost:8000/Api/email/verify/{id}</li>
                        <li>http://localhost:8000/Api/email/resend</li>
                        <h3 class="mb-0">Api Authenticated</h3>
                        <li>http://localhost:8000/api/toko/get-supplier (get semua supplier terdaftar)</li>
                        <li>http://localhost:8000/api/toko/get-supplier-produk/{supplier_id} (get produk dari salah satu supplier)</li>
                        <li>http://localhost:8000/api/toko/order-produk/{produk_id} (order produk)</li>
                        <ul>
                            <h4>kolom input</h4>
                            <li>qty</li>
                        </ul>
                        <li>http://localhost:8000/api/toko/approve-produk (get approve produk)</li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
