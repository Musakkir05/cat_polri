
<?php use Carbon\Carbon; ?> 
@extends('layouts.app')
@section('title','Siswa')
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
          <div class="card-body">
            <div class="justify-content-start">
              <a href="{{route('tambah-siswa')}}" class="btn btn-primary">Tambah siswa</a>
            </div>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nomor</th>
                <th>Nama</th>
                <th>Status</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($UserList as $data)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->No_hp}}</td>
                <td>{{$data->status}}</td>
                <td>{{$data->email}}</td>
                <td><div class="text-center">
                  <a href="edit_siswa/{{$data->id}}" class="btn-sm btn-info">Edit</a><a href="siswa-delete/{{$data->id}}" class="btn-sm btn-danger">Delete</a>
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

@endsection
@push('scripts')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
 
</script>

@if(session('success'))
<script>
  var successMessage = "{{ session('success') }}";
swal("Sukses!", successMessage, "success");
</script>
@endif
@endpush
