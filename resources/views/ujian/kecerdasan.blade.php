<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Document</title>
     <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <style>
    
  </style>
</head>
<body>
<div class="content p-3">
    <div class="row">
        <div class="col-3 d-flex justify-content-between ">
            <div class="card w-100 text-center">
               <h6>Data Peserta</h6>
                <div class="card-body">Nama : Musakkir</div>
            </div>
          </div>
          <div class="col-6  text-center ">
            <div class="card h-100">
                <h6>Tahapan Ujian</h6>
                <div class="card-body">
            <button class="btn-sm btn-success">Kecerdasan</button>
            <button class="btn-sm btn-success">Kepribadian</button>
            <button class="btn-sm btn-success">Kecermatan</button>
                </div>
            </div>
          </div>
          <hr>
          <div class="col-3 d-flex justify-content-end">
            <div class="card w-100 text-center">
                <h6>Waktu Pengerjaan</h6>
                <div class="card-body"></div>
            </div>
          </div>
<div class="row p-2">
    <div class="col-4 bg-blue p-2" >
        <h6>Daftar Soal</h6>
        <nav aria-label="Page navigation">
            <ul class="pagination" style="margin-top: 5px !important;">
                
                @for ($i = 0; $i < 20; $i++)

                    
                <li><button class="btn-sm btn-success m-1 ">{{$i}}</button></li>
                    
                   
                  
                @endfor
                
            </ul>
        </nav>
    </div>
    <div class="col-8 bg-white p-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eveniet, velit cum. Non tempora eum enim cupiditate dolor! Autem dolorum, esse quidem animi quisquam deserunt quam iusto quo officia explicabo. Possimus!</div>
</div>
    </div>
</div>




<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
</body>
</html>