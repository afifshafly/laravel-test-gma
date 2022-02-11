@extends('layouts.app')

@section('content')
@include('layouts.headers.background')
<div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="row">
            <div class="col"><h1 class="text-white text-left">User List</h1></div>
        </div>
        <div class="card">
          <table class="table table-bordered" id="tableProduk">
            <thead>
                <tr>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Verified Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $user as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>{{$user->email_verified_at ? $user->email_verified_at : 'Belum di verifikasi'}}</td>
                    </tr>
                @endforeach
            </tbody>

          </table>
        </div>
      </div>
    </div>
    @include('layouts.footers.footer')
</div>

@endsection
