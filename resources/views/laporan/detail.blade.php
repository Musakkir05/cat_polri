
<?php use Carbon\Carbon; ?> 
@extends('layouts.app')
@section('title','Laporan')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan</h1>
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
                <h3 class="card-title">Hasil Ujian Siswa Dengan Jawaban Salah</h3>
              </div>
              <div class="card-body">
                {{-- <h3>Nama : {{}}</h3> --}}
                @foreach ($result as $jenis_soal => $detail_soal)
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $jenis_soal }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if(isset($detail_soal['jumlah_salah_tidak_dijawab']))
            <h5>Nama : {{$detail_soal['soal'][0]['nama_user']}}</h5>
                <h5>Jumlah Soal Salah/Tidak Dijawab: {{ $detail_soal['jumlah_salah_tidak_dijawab'] }}</h5>
            @endif

            @if(isset($detail_soal['soal']))
                @foreach ($detail_soal['soal'] as $index => $detail)
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">Soal No {{ $index + 1 }}</h5>
                            <p class="card-text">{!! $detail['soal'] !!}</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Kunci Jawaban :</strong> {!! $detail['kunci_jawaban1'] !!} @if ($detail['kunci_jawaban2']!=null) dan {!! $detail['kunci_jawaban2'] !!} @endif</li>
                                <li class="list-group-item"><strong>Isi Jawaban :</strong> {!! $detail['isi_jawaban1'] !!} @if ($detail['isi_jawaban2']) Dan {!! $detail['isi_jawaban2'] !!}
                                    
                                @endif</li>
                                {{-- <li class="list-group-item"><strong>Isi Jawaban 2:</strong> {!! $detail['isi_jawaban2'] !!}</li> --}}
                                @if ($detail['pilihan1'] != null)
                                    <li class="list-group-item"><strong>Pilihan :</strong> {!! $detail['pilihan1'] !!} @if ($detail['pilihan2'] != null) dan {!! $detail['pilihan2'] !!} @endif</li>
                                    <li class="list-group-item"><strong>Isi Pilihan :</strong> {!! $detail['isi_pilihan1'] !!}</li>
                                    @if ($detail['isi_pilihan2'] != null)
                                        <li class="list-group-item"><strong>Isi Pilihan 2:</strong> {!! $detail['isi_pilihan2'] !!}</li>
                                    @endif
                                @else
                                    <li class="list-group-item"><strong>Pilihan:</strong> Tidak dijawab</li>
                                @endif
                                
                            </ul>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endforeach
                
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
