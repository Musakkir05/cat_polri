<?php use Carbon\carbon; ?>
@extends('ujian.layouts.app')
@section('title','Siswa')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="card w-100">
            <div class="card-body ">
                <p>Hai {{auth()->user()->name}}, Selamat datang di aplikasi ujian simulasi CAT polri.</p>
                <p>Untuk memulai simulasi pastikan anda tidak keluar dari halaman ini sampai semua tahapan tes selesai</p>
                <p>Silahkan klik mulai tes untuk memulai tes</p>
                <div class="d-flex justify-content-center">
                    <a href="{{route('kecerdasan')}}"><button class="btn btn-success">Mulai Tes</button></a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
@endsection