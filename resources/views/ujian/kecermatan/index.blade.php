

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
  <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.css')}}">
  <style>

 .question-container {
    display: flex;
        align-items: flex-start; /* Menyusun item ke atas */
    }

    .question-number {
        margin-right: 1px; /* Jarak antara nomor soal dan teks soal */
        font-weight: bold;
    }

    .question-text {
        margin: 0;
        padding-left: 5px; /* Sesuaikan jarak dari kiri */
    }


	

	.timer {
		border: solid thin #b9b2b2;
		padding: 5px 15px;
		font-size: 14pt;
		color: #fff;
		background: #291a71;
	}

	.soal {
		margin: 0 0 15px 0;
	}

	.box-footer {
		border-top: 1px solid #ebebeb !important;
	}



	.pilihan p {
		margin: 0;
	}
     /* Gaya untuk layar yang lebih besar */
     .instruksi-container {
        width: 50%; /* Lebar kontainer instruksi */
      
        text-align: left; /* Set konten menjadi left-aligned */
    }

    /* Gaya untuk layar yang lebih kecil (misalnya, ponsel) */
    @media only screen and (max-width: 700px) {
        .instruksi-container {
            width: 100%; /* Gunakan lebar penuh untuk layar kecil */
        }
    }
    .pertanyaan-container {
        width: 40%; /* Lebar kontainer instruksi */
      
        text-align: left; /* Set konten menjadi left-aligned */
    }

    /* Gaya untuk layar yang lebih kecil (misalnya, ponsel) */
    @media only screen and (max-width: 700px) {
        .pertanyaan-container {
            width: 100%; /* Gunakan lebar penuh untuk layar kecil */
        }
    }
    .pilihan-btn {
    margin-right: 19px; /* Jarak antara tombol */
    border: 2px dashed grey; /* Border putus-putus dengan warna abu-abu dan ketebalan 2px */
    background-color: hsla(108, 5%, 78%, 0.851); /* Latar belakang warna putih */
    padding: 5px 10px; /* Padding tombol */
}
</style>
</head>
<body>
    <div class="content p-3">
        <div class="row ">
            <div class="col-3">
                <div class="card h-100">
                    <div class="info-box-content">
                        <span class="info-box-text ">Data Peserta</span>
                        <h6 class="info-box-number " >
                            <div class="text-center"> 
                                <img style="max-height: 60px;margin-right: 10px;" src="{{ asset('assets/dist/img/user.png') }}" alt="">
                            <span>    {{Auth::user()->name}} </span>
                            
                            </div>
                            
                           </h6>
                      </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card h-100 ">
                    <div class="info-box-content">
                        <div class="info-box-text text-center">Tahapan Ujian</div>
                        <div class="info-box-number ">
                            <div class="card-body text-center">
                                <button class="btn btn-success" disabled>Kecerdasan</button>
                                <button type="button" class="btn  btn-success" disabled>Kepribadian</button>
                                <button type="button" class="btn  btn-success">Kecermatan</button>
                            </div>
                            
                          
                          
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-3">
                <div class="card h-100 ">
                    <div class="info-box-content">
                        <div class="info-box-text text-center">Waktu Pengerjaan</div>
                        <div class="info-box-number ">
                            <div class="card-body text-center" ><h2 id="timer"></h2></div>
                    </div>
            
                    
                </div>
            </div>
        </div>
        </div>
        <hr>
        <div class="row p-2">
            
            <div class="col-12">
                <div class="box-body bg-white p-2">

                    <div id="wrap-soal">
                        <div class="instruksi-container">
                            <h6>Petunjuk</h6>
                            <div class="text-center">
                                <h6 id="no_kolom">Kolom {{$nomor}}</h6>
                            </div>
                            <div id="petunjuk">{!! $petunjuk->soal !!}</div>
                        </div>
                  
                  
                        <div>
                            <div class="pertanyaan-container">
                                <h6>Soal</h6>
                                <div id="soal">{!! $soal['soal'] !!}</div>
                                <div class="pilihan" id="fullscreen">
                                    <button class="pilihan-btn"  id_instruksi="{{$soal->id_instruksi}}"
                                        id_pertanyaan="{{$soal->id}}"  data-answer="A">A</button>
                                    <button class="pilihan-btn"id_instruksi="{{$soal->id_instruksi}}"
                                        id_pertanyaan="{{$soal->id}}"  data-answer="B">B</button>
                                    <button class="pilihan-btn" id_instruksi="{{$soal->id_instruksi}}"
                                        id_pertanyaan="{{$soal->id}}" data-answer="C">C</button>
                                    <button class="pilihan-btn" id_instruksi="{{$soal->id_instruksi}}"
                                        id_pertanyaan="{{$soal->id}}"  data-answer="D">D</button>
                                    <button class="pilihan-btn" id_instruksi="{{$soal->id_instruksi}}"
                                        id_pertanyaan="{{$soal->id}}" data-answer="E">E</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    




<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ url('js/jquery.fullscreen-min.js') }}"></script>
<script>
   
    </script>
<script>
    var waktuAwal = {{$petunjuk['waktu']}} * 60;
    var no_kolom = {{$nomor}}
    var idPetunjukSaatIni = {{$petunjuk['id']}};
    var countdownInterval;
    function resetTimerForNewInstruction(newTime) {
        waktuAwal = newTime;
        clearInterval(countdownInterval); 
        startTimer(); 
    }
    function updateSoal(data,no_kolom) {
        $('#soal').html('<center><i class="fa fa-spinner fa-spin" style="font-size: 30pt; color: #12b9cc; margin: 15px;" aria-hidden="true"></i></center>');

        $('#no_kolom').html('Kolom ' + no_kolom);
        $('#soal').html(data.soal.soal);
   
        $('.pilihan-btn').each(function () {
            $(this).attr('id_instruksi', data.petunjuk.id);
            $(this).attr('id_pertanyaan', data.soal.id);
        });
     
    }

    function updateSoalDanPetunjuk(data,no_kolom) {
        $('#no_kolom').html('Kolom ' + no_kolom);
        console.log(data.soal.id);
        $('#soal').html(data.soal.soal);
        $('#petunjuk').html(data.petunjuk.soal);
        $('.pilihan-btn').each(function () {
            $(this).attr('id_instruksi', data.petunjuk.id);
            $(this).attr('id_pertanyaan', data.soal.id);
        });
        resetTimerForNewInstruction(data.petunjuk.waktu * 60); // 
    }
    function updateTimer() {
        var jam = Math.floor(waktuAwal / 3600);
        var menit = Math.floor((waktuAwal % 3600) / 60);
        var detik = waktuAwal % 60;
        var timerText = jam + ":" + menit + ":" + detik;
        document.getElementById('timer').innerHTML = timerText;
    }

    function startTimer() {
        
    countdownInterval = setInterval(function () {
        waktuAwal--; 
        updateTimer(); 

        if (waktuAwal <= 0) {
            clearInterval(countdownInterval);  
            idPertanyaan = 199999; 
            idInstruksi = idPetunjukSaatIni;

            $.ajax({
                type: 'GET',
                url: "{{ url('/ujian/kecermatan/get-soal') }}",
                data: {
                    id_instruksi: idInstruksi,
                    id_pertanyaan: idPertanyaan,
                    answer: '', 
                },
                success: function (data) {
                    
                    if (data=='ok') {
                        Swal.fire({
                        title: "Ujian Telah Selesai",
                        text: "Ujian telah selesai. Silahkan lihat menu laporan untuk melihat hasil ujian.",
                        icon: "success",
                        showConfirmButton: true, 
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonText: "OK"
                        }).then((result) => {
                        if (result.isConfirmed) {
                            
                            window.location.href = "/ujian/index";
                        }
                        });
                    }else{
                        no_kolom++;
                        Swal.fire({
                    title: 'Persiapan Ke Kolom '+no_kolom+'',
                    html: " <b></b> Detik.",
                    timer: 5005,
                    timerProgressBar: true,
                    icon: 'warning',
                    showConfirmButton: false, 
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                        const timeLeft = Swal.getTimerLeft();
                        timer.textContent = `${Math.ceil(timeLeft / 1000)}`; 
                        }, 1000); 
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                });
                    }
                    

              
                setTimeout(function () {
                    
                    updateSoalDanPetunjuk(data,no_kolom);
                    idPetunjukSaatIni = data.petunjuk.id;
                }, 5000); 
                   
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }, 1000); 
}
 document.addEventListener("DOMContentLoaded", function() {
        var countdownTimer; // Untuk menyimpan timerInterval
    
        // Fungsi untuk menampilkan alert dengan hitung mundur
        function showCountdownAlert() {
            Swal.fire({
            title: 'Persiapan Tahap Kecermatan',
            html: " <b></b> Detik.",
            timer: 5000, // Waktu dalam milidetik (5 detik)
            timerProgressBar: true,
            icon: 'warning',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                var countdownTime = 5; // Hitung mundur dari 5 detik
                var countdownInterval = setInterval(() => {
                    timer.textContent = countdownTime;
                    countdownTime--;
                    if (countdownTime < 0) {
                        clearInterval(countdownInterval); // Hentikan countdown saat mencapai 0
                        startTimer(); // Memulai hitungan mundur waktu pengerjaan
                        Swal.close(); // Tutup alert setelah countdown selesai
                    }
                }, 1000);
            }
        });
    }
    
        // Panggil fungsi showCountdownAlert saat halaman dimuat
        showCountdownAlert();
    });
    // Menambahkan event listener untuk peristiwa klik pada tombol "Next"
    document.getElementById('fullscreen').addEventListener('click', function() {
        mintaLayarPenuh();
    });

    // Fungsi untuk meminta mode layar penuh
    function mintaLayarPenuh() {
        var elemen = document.documentElement;
        if (elemen.requestFullscreen) {
            elemen.requestFullscreen();
        } else if (elemen.mozRequestFullScreen) {
            elemen.mozRequestFullScreen();
        } else if (elemen.webkitRequestFullscreen) {
            elemen.webkitRequestFullscreen();
        } else if (elemen.msRequestFullscreen) {
            elemen.msRequestFullscreen();
        }
    }
$(document).ready(function () {

    $(document).on('click', '.pilihan-btn', function (e) {
        const idInstruksi = this.getAttribute('id_instruksi');
        const idPertanyaan = this.getAttribute('id_pertanyaan');
        const answer = this.getAttribute('data-answer');
    
        $.ajax({
            type: 'GET',
            url: "{{ url('/ujian/kecermatan/get-soal') }}",
            data: {
                id_instruksi: idInstruksi,
                id_pertanyaan: idPertanyaan,
                answer: answer,
            },
            success: function (data) {
                if (data=='ok') {
                        Swal.fire({
                        title: "Ujian Telah Selesai",
                        text: "Ujian telah selesai. Silahkan lihat menu laporan untuk melihat hasil ujian.",
                        icon: "success",
                        showConfirmButton: true, 
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonText: "OK"
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/ujian/index";
                        }
                        });
                    }
               
                if (idPetunjukSaatIni != data.petunjuk.id) {
                    no_kolom++;
                Swal.fire({
                    title: 'Persiapan Ke Kolom '+no_kolom+'',
                    html: " <b></b> Detik.",
                    timer: 5005, 
                    timerProgressBar: true,
                    icon: 'warning',
                    showConfirmButton: false, 
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                        const timeLeft = Swal.getTimerLeft();
                        timer.textContent = `${Math.ceil(timeLeft / 1000)}`; 
                        }, 1000); 
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                });

                
                setTimeout(function () {
                   
                    updateSoalDanPetunjuk(data,no_kolom);
                    idPetunjukSaatIni = data.petunjuk.id; 
                }, 5000); 
            } else {
                
                updateSoal(data,no_kolom);
            }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });



});

</script>



</body>
</html>

