{{-- @dd($result) --}}
@php
    $count = count($result);
    if ($count<=1) {
      return redirect()->route('home');
    }
@endphp
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
                <h3 class="card-title">Hasil Ujian Siswa</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped"  id="tablesoal">
                  <thead>
                  <tr>
                    <th class="text-center" data-name="Nomor">Nomor</th>
                    <th class="text-center" data-name="Nama Siswa">Nama Siswa</th>
                    <th class="text-center" data-name="Kecerdasan">Kecerdasan</th>
                    <th class="text-center" data-name="Kepribadian">Kepribadian</th>
                    <th class="text-center" data-name="Kecermatan">Kecermatan</th>
                    <th class="text-center" data-name="Aksi">Aksi</th>
    
                  </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($result as $idUser => $user)
                    <tr>
                   
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $user['nama'] }}</td>
                        <td class="text-center" >
                          <ul style="list-style-type: none; padding: 0; margin: 0;">
                            <li>Benar : {{ $user['nilai']['Kecerdasan']['jawaban_benar'] }}</li>
                            <li>Salah/Tidak diJawab : {{$user['nilai']['Kecerdasan']['jumlah_soal']-$user['nilai']['Kecerdasan']['jawaban_benar']}}</li>
                            <li>Nilai :{{ ($user['nilai']['Kecerdasan']['jawaban_benar']/$user['nilai']['Kecerdasan']['jumlah_soal'])*100 }}</li>
                            
                          </ul>
                      </td>
                      <td class="text-center" >
                        <ul style="list-style-type: none; padding: 0; margin: 0;">
                          <li>Benar : {{ $user['nilai']['Kepribadian']['jawaban_benar'] }}</li>
                          <li>Salah/Tidak diJawab : {{$user['nilai']['Kepribadian']['jumlah_soal']-$user['nilai']['Kepribadian']['jawaban_benar']}}</li>
                          <li>Nilai :{{ ($user['nilai']['Kepribadian']['jawaban_benar']/$user['nilai']['Kepribadian']['jumlah_soal'])*100 }}</li>
                          
                        </ul>
                      </td>
                      <td class="text-center">
                        <table>
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
                        <td class="text-center"> 
                          <a href="/laporan/detail/{{$idUser}}" class="btn-sm btn-success">Detail</a>
                          <a href="javascript:void(0)" onclick="deleteUjian({{$idUser}})" class="btn-sm btn-danger">Hapus</a>
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

@push('scripts')
<script>
  $(document).ready(function() {
// Inisialisasi DataTables
$('#tablesoal').DataTable();

});
   
   function deleteUjian(id){

        Swal.fire({
  title: "Apakah kamu yakin menghapus data ini?",
  
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, Hapus!"
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
            url:'/laporan/delete-ujian/'+id,
            type : 'DELETE',
            data:{
              _token:$("input[name=_token]").val()
            },success:function(response){
              $('$sid'+id).remove();
            }
          
          })
    Swal.fire({
      title: "Deleted!",
      text: "Data telah terhapus.",
      icon: "success"
    });
    location.reload();
  }
});
        
    
      } 


</script>

@endpush