<?php use Carbon\Carbon; ?> 
@extends('layouts.app')
@section('title','Dashboard')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Selamat Datang</li>
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
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Kecerdasan</span>
                @php
                use App\Models\DetailSoal;
                $detailsoal = DetailSoal::all();
                      $sum = $detailsoal->where('jenis', 'Kecerdasan')->where('status', 'Y')->count();
                @endphp
                <span class="info-box-number">{{$sum}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Kepribadian</span>
                @php
                $detailsoal = DetailSoal::all();
                      $sum = $detailsoal->where('jenis', 'Kepribadian')->where('status', 'Y')->count();
                @endphp
                <span class="info-box-number">{{$sum}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Kecermatan</span>
                @php
                use App\Models\Pertanyaan;
                $sum = Pertanyaan::all();
                      $sum = $sum->where('status', 'Y')->count();
                @endphp
                <span class="info-box-number">{{$sum}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Siswa</span>
                @php
                use App\Models\User;
                $sum = User::all();
                      $sum = $sum->where('status', 'Siswa')->count();
                @endphp
                <span class="info-box-number">{{$sum}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="center">
            <button onclick="resetUjian()" class="btn btn-danger">Reset data ujian</button>
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
@push('scripts')
    <script>
    
        function resetUjian() {
    Swal.fire({
        title: "Apakah kamu yakin ingin mereset ujian?",
        text: "Semua data ujian akan dihapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Reset!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/reset-ujian',
                type: 'DELETE',
                data: {
                  _token:$("input[name=_token]").val()
                },
                success: function (response) {
                    Swal.fire({
                        title: "Reset!",
                        text: "Semua data ujian telah dihapus.",
                        icon: "success"
                    }).then(() => {
                        location.reload(); // Reload halaman setelah penghapusan berhasil
                    });
                }
            });
        }
    });
}
    
    </script>
@endpush
@endsection
