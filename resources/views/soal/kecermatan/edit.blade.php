
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
          <h1 class="m-0">Edit Petunjuk</h1>
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
            <h3 class="card-title">Ubah Soal</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form class="form-horizontal" id="form-soal">
              @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Soal</label>
                    <div class="col-sm-10">
                      <input type="hidden" name="id" value="{{$soal->id}}">
                      <!-- <input type="hidden" name="id_soal" value="N"> -->
                      <input type="hidden" name="jenis" value="{{$soal->jenis}}">
                      <input type="hidden" name="sesi" value="{{ md5(rand(0000000000, mt_getrandmax())) }}">
                      <textarea class="form-control textarea" name="soal" placeholder="Soal">{{$soal->soal}}</textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label><input type="radio" name="status" id="y" value="Y" @if($soal->status == "Y") checked @endif> Tampil</label> &nbsp;&nbsp;&nbsp;
                            <label><input type="radio" name="status" id="n" value="N" @if($soal->status == "N") checked @endif> Tidak tampil</label>
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

@if (Session::has('message'))
<script>
  $(document).Toasts('create', {
    class: 'bg-success',
    title: 'Toast Title',
    subtitle: 'Subtitle',
    body: 'Data Berhasil di hapus.'
});
// toastr.success("{{Session::get('message')}}"); 
</script>
@endif
<script>
    $(document).ready(function () {
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
				fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150']
	});
  $('#simpan-soal').click(function () { 

    $("#wrap-btn").hide();
    $("#loading-soal").show();
    var dataString = $("#form-soal").serialize();
    console.log(dataString);
    $.ajax({
      type: "POST",
      url: "{{ url('/soal/kecermatan/update')}}",
      data: dataString,
      success: function( data){
        $("#loading-soal").hide();
        $("#wrap-btn").show();
        if (data == 'ok') {
            var successMessage = "Soal berhasil diubah.";
    window.location.href = "{{ url('soal/detailSoal/' . $soal->id_paket) }}?success=" + encodeURIComponent(successMessage);
            

        }else{
          $("#notif-soal").removeClass('alert alert-info').addClass('alert alert-danger').html(data).show();
        }
      }
    })
    
  });
    });
</script>
@endpush
