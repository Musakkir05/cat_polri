
<?php use Carbon\carbon; ?>
@extends('ujian.layouts.app')
@section('title','Laporan Siswa')

@section('content')
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
            <h3 class="card-title">Hasil Ujian Siswa</h3>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped"  id="tablesoal">
              <thead>
              <tr>
                <th class="text-center" data-name="Nomor">Nomor</th>
               
                <th class="text-center" data-name="Kecerdasan">Kecerdasan</th>
                <th class="text-center" data-name="Kepribadian">Kepribadian</th>
                <th class="text-center" data-name="Kecermatan">Kecermatan</th>
                

              </tr>
              </thead>
              <tbody>
                
                @foreach($result as $idUser => $user)
                <tr>
               
                    <td class="text-center">{{ $loop->iteration }}</td>
                 
                    <td class="text-center" >
                      <ul style="list-style-type: none; padding: 0; margin: 0;">
                        <li>Benar : {{ $user['nilai']['Kecerdasan']['jawaban_benar'] }}</li>
                        <li>Salah/Tidak diJawab : {{$user['nilai']['Kecerdasan']['jumlah_soal']-$user['nilai']['Kecerdasan']['jawaban_benar']}}</li>
                        <li>Nilai :{{ $user['nilai']['Kecerdasan']['nilai'] }}</li>
                      </ul>
                  </td>
                  <td class="text-center" >
                    <ul style="list-style-type: none; padding: 0; margin: 0;">
                      <li>Benar : {{ $user['nilai']['Kepribadian']['jawaban_benar'] }}</li>
                      <li>Salah/Tidak diJawab : {{$user['nilai']['Kepribadian']['jumlah_soal']-$user['nilai']['Kepribadian']['jawaban_benar']}}</li>
                      <li>Nilai :{{ $user['nilai']['Kepribadian']['nilai'] }}</li>
                    </ul>
                  </td>
                  <td class="text-center">
                    <style>
                        .inner-table {
                            margin: 0 auto; /* Untuk memusatkan tabel */
                        }
                    </style>
                    <table class="inner-table">
                        <tbody>
                            @php
                                $kolom = 1; // Inisialisasi nilai kolom
                            @endphp
                            @foreach($user['nilai']['Kecermatan'] as $id_instruksi => $nilai)
                                @if(is_array($nilai))
                                    @if($kolom % 3 == 1)
                                        <tr> <!-- Mulai baris baru setiap tiga kolom -->
                                    @endif
                                    <td style="vertical-align: top;" class="text-center">
                                        <ul style="list-style-type: none; padding: 0; margin: 0;">
                                            <li><strong>Kolom {{ $kolom }}</strong></li>
                                            <!-- Tampilkan nilai jawaban -->
                                            <li>Benar: {{ $nilai['jawaban_benar'] }}</li>
                                            <li>Salah: {{ $nilai['jawaban_salah'] }}</li>
                                            <li>Kosong: {{ $nilai['jawaban_kosong'] }}</li>
                                        </ul>
                                    </td>
                                    @if($kolom % 5 == 0)
                                        </tr> <!-- Akhiri baris setiap tiga kolom -->
                                    @endif
                                    @php  
                                        $kolom++; // Tambahkan 1 ke nilai kolom
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </td>
                    
                </tr>
                @endforeach
              </tfoot>
            </table>
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