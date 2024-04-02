<?php use Carbon\Carbon; ?> 
@extends('layouts.app')
@section('title','Edit Siswa')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Siswa</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
                <form action="/siswa/siswa-update/{{$siswa->id}}" method="post" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="nama" name="name" value="{{$siswa->name}}">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-6">
                          <input type="number" class="form-control" name="No_hp" id="no_hp" autocomplete="off" value="{{$siswa->No_hp}}">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="email1" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-6">
                          <input type="email" class="form-control" id="email1" autocomplete="off" name="email" value="{{$siswa->email}}">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="password1" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-6">
                          <input type="password" class="form-control" name="password" id="pass" autocomplete="new-password" value="{{$siswa->password}}">
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
    </div>
    <!-- /.content-wrapper -->
  
  @endsection