
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
            <h1 class="m-0">Petunjuk</h1>
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
          <h3 class="card-title">Data Petunjuk</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body center">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Total Petunjuk</span>
                  <span class="info-box-number">{{count($soalList)}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Total Soal</span>
                  <span class="info-box-number">{{$jumlah_soal}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Tampil</span>
                  @php
                      $countSoal = $soalList->where('status','=','Y')->count(); 
                  
                  @endphp
                  <span class="info-box-number=">{{$countSoal}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3  col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Tidak Tampil</span>
                  @php
                      $countSoal = $soalList->where('status','=','N')->count(); 
                  
                  @endphp
                  <span class="info-box-number">{{$countSoal}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
           </div>
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
                        <img src="{{ url('assets/dist/img/ZKZg.gif') }}" style="display: none;" id="loading-soal">
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
                        <td  style="max-width: 400px;">{!! $data->soal !!}</td>
                        <td>{!!$data->waktu!!}</td>
                        <td style="text-align: center">
                          @if($data->status == 'Y')
                              <span class="btn-sm btn-success">Tampil</span>
                          @elseif($data->status == 'N')
                              <span class="btn-sm btn-warning">Tidak Tampil</span>
                          @endif
                      </td>
                        <td style="text-align: center" class="gap-2">
          
                            <a href="/soal/kecermatan/edit/{{$data->id}}" class="btn-sm btn-primary" >Edit</a>
                            <a href="/soal/kecermatan/pertanyaan/detail-pertanyaan/{{$data->id}}" class="btn-sm btn-info">Detail</a>
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
		toolbar: [
						['style', ['style']],
				    ['font', ['bold', 'italic', 'underline', 'clear']],
				    ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']]
        ],
        height:100,
				fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
        callbacks: {
        onInit: function() {
            var content = '<table class="table table-bordered">' +
                                '<tbody>' +
                                    '<tr><td></td><td></td><td></td><td></td><td></td></tr>' +
                                    '<tr><td></td><td></td><td></td><td></td><td></td></tr>' +
                                '</tbody>' +
                              '</table>';
            $('.textarea').summernote('code', content);
        }
    }
	});


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





