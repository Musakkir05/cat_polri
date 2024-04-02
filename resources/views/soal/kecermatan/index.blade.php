
<?php use Carbon\Carbon; ?> 
@extends('layouts.app')
@section('title','Soal Kepribadian')
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
          <h3 class="card-title">Data Soal</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body center">
            <button type="button" id="btn-soal" class="btn btn-primary btn-md">Tulis Soal</button>
            <div style="display:none" id="wrap-soal">
                <form class="form-horizontal" id="form-soal" method="post">
                  @csrf
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Soal</label>
                      <div class="col-sm-10">
                        <input type="hidden" name="id_paket" value="{{request()->id}}">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <input type="hidden" name="sesi" value="{{ md5(rand(0000000000, mt_getrandmax())) }}">
                        <textarea class="form-control textarea" name="soal"  placeholder="soal"></textarea>
                      </div>
                    </div>
 
                    <div class="form-group" style="margin-top: 15px">
                      <label class="col-sm-2 control-label">Waktu</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control numOnly" name="waktu" placeholder="Waktu">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <div class="radio">
                          <label><input type="radio" name="status" id="y" value="Y"> Tampil</label> &nbsp;&nbsp;&nbsp;
                          <label><input type="radio" name="status" id="n" value="N"> Tidak tampil</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group" style="margin-top: 20px">
                      <div class="col-sm-offset-2 col-sm-10">
                        <div id="notif-soal" style="display: none;"></div>
                        <img src="{{ url('/assets/images/facebook.gif') }}" style="display: none;" id="loading-soal">
                        <div id="wrap-btn">
                          <button type="button" class="btn btn-danger" id="batal">Batal</button>
                          <button type="button" class="btn btn-success" id="simpan-soal">Simpan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="well" style="margin-top: 15px; display: none;" id="wrap-upload-soal">
                {{-- <form class="form-horizontal" action="{{ url('/crud/simpan-detail-soal-via-excel') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group">
                      <input type="file" name="file" id="file" class="inputfile" />
                      <label for="file"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Pilih file excel</label>
                      <p class="help-block">Silahkan pilih file format soal dalam bentuk excel yang telah diisi dengan benar.</p>
                    </div>
                    <div class="box-footer">
                      <input class="btn btn-danger" id="batal-upload" type="button" value="Batal" />
                      <input class="btn btn-primary" name="upload" type="submit" value="Import" />
                    </div>
                  </div>
                </form> --}}
              </div>
             
              <table class="table table-bordered table-striped" id="tablesoal">
                <thead>
                  <tr>  
                    <th>NO</th>
                    <th>Instruksi</th>
          
                    <th style="text-align: center;">Waktu</th>
                    <th style="text-align: center;">Status</th>
                
                    <th style="text-align: center;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($soalList as $key=>$data)
                    
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!!$data->soal!!}</td>
                        <td>{!!$data->waktu!!}</td>
                        <td>{!!$data->status!!}</td>
                        <td style="text-align: center">
          
                            <a href="/soal/kepribadian/edit/{{$data->id}}" class="btn-sm btn-primary" >Edit</a>
                            <a href="/edit-paket/{{$data->id}}" class="btn-sm btn-info">Detail</a>
                            <a href="javascript:void(0)" onclick="deleteSoal({{$data->id}})" class="btn-sm btn-danger">Hapus</a>

                          </td>
                    </tr>
                    @endforeach
                   
                </tbody>
              </table>
            
          
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

@push('scripts')

<script>
    $(document).ready(function() {
        $("#btn-soal").click(function() {
      $("#wrap-soal").slideToggle();
    });
        $('.textarea').summernote({

        height:500,
        
				fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150']
	})

    $("#tablesoal").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
      $("#simpan-soal").click(function() {
        $("#wrap-btn").hide();
        $("#loading-soal").show();
        var dataString = $("#form-soal").serialize();

        $.ajax({
          type: "POST",
          url: "{{ url('/soal/kecermatan/index') }}",
          data: dataString,
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
          success: function(data) {
            $("#loading-soal").hide();
            $("#wrap-btn").show();
            if (data == 'done') {
              swal({
                title: "Sukses!",
                text: "Data berhasil ditambahkan",
                icon: "success",
            }).then(function() {
                location.reload();
            });
             
            } else {
              $("#notif-soal").removeClass('alert alert-info').addClass('alert alert-danger').html(data).show();
            }
          }
        })

    });

</script>
<script>
$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var successMessage = urlParams.get('success');
    if (successMessage ) {
        swal("Sukses!", successMessage, "success").then(function() {
            // Setel ulang URL tanpa query string setelah mengklik OK pada alert
            window.history.replaceState({}, document.title, window.location.pathname);
        });
    }
});
      function deleteSoal(id){
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
            url:'/soal/kecermatan/delete-soal/'+id,
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
    }).then(function() {
                location.reload();
            });
    
    
  }
});
        
    
      }
     
</script>
@endpush





