<?php use Carbon\Carbon; ?> 
@extends('layouts.app')
@section('title','Soal')
@section('content')

  <!-- Content Wrapper. Contains page content -->
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
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data siswa</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body center">
            <form action="/soal/update-paket/{{$paket->id}}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="nama" name="name" value="{{$paket->jenis}}" readonly>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="deskripsi" id="deskripsi" autocomplete="off" value="{{$paket->deskripsi}}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="kkm" class="col-sm-2 col-form-label">KKM</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="kkm" autocomplete="off" name="kkm" value="{{$paket->kkm}}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="waktu" class="col-sm-2 col-form-label">Waktu Tes</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="waktu" id="waktu" value="{{$paket->waktu}}">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </section>
  <!-- /.content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
