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
            <h1 class="m-0">Paket</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Soal</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tablesoal" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th class="text-center">Nomor</th>
                <th class="text-center">Jenis</th>
                <th class="text-center">Deskripsi</th>
                <th class="text-center">Kriteria Ketuntasan Minimal(KKM)</th>
                <th class="text-center">Waktu</th>
                <th class="text-center">Aksi</th>

              </tr>
              </thead>
              <tbody>
                @foreach ($SoalList as $data)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->jenis}}</td>
                <td>{{$data->deskripsi}}</td>
                <td>{{$data->kkm}}</td>
                <td>{{$data->waktu}}</td>
                <td><div class="button-container text-center">
                  <a href="edit-paket/{{$data->id}}" class="btn-sm btn-info ">Edit</a><a href="detailSoal/{{$data->id}}" class="btn-sm btn-success">Detail</a>
                </div>
                </td>
              </tr>
              @endforeach
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @push('scripts')
  @if (Session::has('message'))
<script>
    toastr.success("{{Session::get('message')}}"); 

</script>

      
  @endif
<script>
      $(document).ready(function() {
     
     $("#tablesoal").DataTable({
       "responsive": true, "lengthChange": false, "autoWidth": false,
 
     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
     })
</script>
  @endpush

@endsection
