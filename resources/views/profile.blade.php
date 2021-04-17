@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
{{-- <h1>Profile</h1> --}}
@stop

@section('content')
{{-- <p>Hello {{ $user }}, welcome to your profile page</p> --}}
<div class="row">
    {{-- <div class="col-md-12 text-right mb-5">
    <button type="button" class="btn btn-warning float-left btn_back"> Back</button>
   
</div> --}}
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Profil</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>{{ $user->telepon }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td><p class="text-capitalize">{{ $user->role }}</p></td>
                    </tr>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script> console.log('Hi!'); </script>
@stop