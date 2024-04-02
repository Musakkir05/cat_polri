
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
    	.jawab {
            padding: 3px;
        margin: 7px;
    display: block; /* Mengubah tata letak elemen menjadi blok */
    width: 100%; /* Menyesuaikan lebar dengan parent */
    text-align: left; /* Mengatur teks ke kiri */
    background-color: #ffffff;
    border: 0px;
	}
    	.dijawab {
            cursor: pointer;
    margin: 7px 0 7px 7px;
		    width: 100%; /* Menyesuaikan lebar dengan parent */
    text-align: left; /* Mengatur teks ke kiri */
    background-color: #15C12C;
    border: 0px;
    padding: 5px 10px;
    border-radius: 4px;
    color: #ebebeb;
	}
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


	

	.pagination{
        display: flex;
        flex-wrap: wrap;
       
    }
	.pagination>li>button {
		width: 50px;
		text-align: center;
		margin: 3px;
        background-color: #a7a7ab;
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
                                <button class="btn btn-success {{ $soal[0]['jenis'] === 'Kecerdasan' ? '' : 'disabled' }}">Kecerdasan</button>
                                <button type="button" class="btn  btn-success {{ $soal[0]['jenis'] === 'Kepribadian' ? '' : ' disabled'  }}">Kepribadian</button>
                                <button type="button" class="btn  btn-success {{ $soal[0]['jenis'] === 'Kecermatan' ? '' : ' disabled'  }}">Kecermatan</button>
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
            <div class="col-3 border-right">
                <div class="box-body bg-white p-2">
                    <h6>Daftar Soal</h6>
                    @if ($soal->count())
                    <nav aria-label="Page navigation">
                        <ul class="pagination" style="margin-top: 5px !important;">
                        @foreach ($soal as $key_number=>$data_number)
                        
                        <li class="no_soal" id="{{ 'nav'.$data_number->id }}" data-id="{{ $data_number->id }}" data-no="{{ $key_number+1 }}">
                            {{-- <a href="#" style="width: 40px !important;">{{ $key_number+1 }}</a> --}}
                        <button class="btn">{{ $key_number+1 }}</button>
                        </li>
                        @endforeach
                           
                    </ul>
                    </nav>
                    @endif
                </div>
            </div>
            <div class="col-9">
                <div class="box-body bg-white p-2">
                    <div id="wrap-soal">
                        @if ($soal->count())
                        
                        @foreach ($soal as $keys =>$data)
                        
                       @if ($keys==0)
                       <span class="detail_soal_id" style="display: none;">{{ $data->id }}</span>
                      
                     
                      <div class="question-container">
                         @if($keys  == 0)
                        
                       <p id="no_soal_detail" class="question-number">1.</p>
                      @endif
                      <p class="question-text">{!! $data->soal !!}</p>
                        </div>
                       
                       {!! $data->pilA ? '<button class="jawab " paket-id="'.$data->id_paket.'" data-id="'.$data->id.'" data-jawab="A">
						<table width="100%">
							<tr>
								<td width="15px" valign="top"><span>A.</span></td>
								<td valign="top" class="pilihan">'.$data->pilA.'</td>
							</tr>
						</table>
					</button>' : '' !!}
					{!! $data->pilB ? '<button class="jawab" paket-id="'.$data->id_paket.'" data-id="'.$data->id.'" data-jawab="B">
						<table width="100%">
							<tr>
								<td width="15px" valign="top"><span>B.</span></td>
								<td valign="top" class="pilihan">'.$data->pilB.'</td>
							</tr>
						</table>
					</button>' : '' !!}
					{!! $data->pilC ? '<button class="jawab" paket-id="'.$data->id_paket.'" data-id="'.$data->id.'" data-jawab="C">
						<table width="100%">
							<tr>
								<td width="15px" valign="top"><span>C.</span></td>
								<td valign="top" class="pilihan">'.$data->pilC.'</td>
							</tr>
						</table>
					</button>' : '' !!}
					{!! $data->pilD ? '<button class="jawab" paket-id="'.$data->id_paket.'" data-id="'.$data->id.'" data-jawab="D">
						<table width="100%">
							<tr>
								<td width="15px" valign="top"><span>D.</span></td>
								<td valign="top" class="pilihan">'.$data->pilD.'</td>
							</tr>
						</table>
					</button>' : '' !!}
					{!! $data->pilE ? '<button class="jawab" paket-id="'.$data->id_paket.'" data-id="'.$data->id.'" data-jawab="E">
						<table width="100%">
							<tr>
								<td width="15px" valign="top"><span>E.</span></td>
								<td valign="top" class="pilihan">'.$data->pilE.'</td>
							</tr>
						</table>
					</button>' : '' !!}

                       @endif
                      
                    @endforeach
                
                    @endif
                
                    </div>
                    <button class="btn btn-warning btn-block" id="next">Next soal</button>
                </div>
            </div>
        </div>
    </div>
    




<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

<script>
    $(document).ready(function () {
        var jawab = [];
    var jawabanSiswa = {}; // Objek untuk menyimpan jawaban yang dipilih
     // Waktu awal dalam detik (90 menit)
     var waktuAwal = <?php echo $paket[0]['waktu'] ?> * 60; // 90 menit * 60 detik

    // Mulai countdown timer
    var timerInterval = setInterval(function() {
         // Hitung jam, menit, dan detik dari waktu awal
        var jam = Math.floor(waktuAwal / 3600);
        var sisaDetik = waktuAwal % 3600;
        var menit = Math.floor(sisaDetik / 60);
        var detik = sisaDetik % 60;

         // Format waktu
         var timerText = jam + ' : ' + menit + ' : ' + detik ;

        // Tampilkan timer di dalam elemen dengan id "timer"
         document.getElementById('timer').innerHTML = timerText;

         // Kurangi waktu awal setiap detik
        waktuAwal--;

         // Cek apakah waktu telah habis
         if (waktuAwal < 0) {
             clearInterval(timerInterval); // Hentikan timer
            document.getElementById('timer').innerHTML = 'Waktu habis!'; // Tampilkan pesan waktu habis
             // Lakukan tindakan setelah waktu habis (misalnya, lanjut ke tes selanjutnya)
         }
     }, 1000); // Update timer setiap 1 detik (1000 milidetik)

     $(document).on('click', ".no_soal", function() {
        var $this = $(this);
        $('#wrap-soal').html('<center><i class="fa fa-spinner fa-spin" style="font-size: 30pt; color: #12b9cc; margin: 15px;" aria-hidden="true"></i></center>');
        $('#no_soal_detail').html($this.attr('data-no'));
        var id_soal = $this.attr('data-id');
        var nomorSoal = $this.attr('data-no');
        console.log(id_soal);
        $('#no_soal_detail').html(nomorSoal + '.');
        if (jawabanSiswa[id_soal] && jawabanSiswa[id_soal].length > 0) {
            // Ubah warna latar belakang tombol menjadi hijau karena sudah ada jawaban yang dipilih
            $this.find('button').css({
                "background-color": "#15C12C",
                "color": "#fff",
            });
        }
        $.ajax({
            type: "GET",
            url: "{{ url('/ujian/kepribadian/get-soal') }}?nomor_soal=" + nomorSoal + "&id_soal=" + id_soal,
            success: function (data) {
                $('#wrap-soal').html(data);
                currentSoalIndex = parseInt(nomorSoal);
               
            }
        })
    });
// Menyimpan urutan nomor soal
var nomorSoalUrutan = [
    @foreach ($soal as $key_number => $data_number)
        {{ $data_number->id  }},
    @endforeach
];



// Inisialisasi indeks nomor soal saat ini
var currentSoalIndex = 1;


$('#next').click(function () {
    // Memperoleh nomor soal berikutnya

    var nextSoalNumber = nomorSoalUrutan[currentSoalIndex];
 
    // Periksa apakah nomor soal berikutnya tersedia
    if (nextSoalNumber !== undefined) {
        // Memperbarui nomor soal saat ini
        currentSoalIndex++;

        // Cari elemen navigasi yang sesuai dengan nomor soal berikutnya
        var $nextSoalButton = $('#nav' + nextSoalNumber);

        // Periksa apakah elemen navigasi ditemukan
        if ($nextSoalButton.length) {
            // Klik tombol navigasi soal berikutnya
            $nextSoalButton.click();
        } else {
            // Tampilkan pesan jika elemen navigasi tidak ditemukan
            alert('Elemen navigasi untuk soal berikutnya tidak ditemukan.');
        }
    } else {
        // Tampilkan pesan jika tidak ada soal berikutnya
        alert('Soal telah habis.');
    }
});



 

    $(document).on('click', ".jawab", function() {
    var $this = $(this);

    var selectedOption = $this.attr('data-jawab');
    var idSoal = $this.attr('data-id');
    var idPaket = $this.attr('paket-id');

    // Periksa apakah jawaban sudah dipilih sebelumnya
    if (!jawabanSiswa[idSoal]) {
        jawabanSiswa[idSoal] = []; // Inisialisasi array jawaban yang dipilih
    }

    // Periksa apakah jumlah jawaban yang dipilih belum mencapai 2
    if (jawabanSiswa[idSoal].length < 1 || jawabanSiswa[idSoal].includes(selectedOption)) {
        // Periksa apakah jawaban sudah dipilih sebelumnya
        if (jawabanSiswa[idSoal].includes(selectedOption)) {
            // Jika sudah dipilih, hapus dari daftar jawaban yang dipilih
            jawabanSiswa[idSoal] = jawabanSiswa[idSoal].filter(function (item) {
                return item !== selectedOption;
            });
            // Ubah tampilan kembali menjadi tidak dipilih
            $this.removeClass('dijawab');
            // Ubah warna tombol kembali menjadi putih
            $this.css('background-color', '#ffffff');

            // Jika tidak ada jawaban dipilih untuk soal ini, ubah warna tombol navigasi daftar soal menjadi putih
            if (jawabanSiswa[idSoal].length === 0) {
                $('#nav' + idSoal).find('button').css({
                    "background-color": "#a7a7ab",
                    "color":"#090808",

                

            });
            }
            $.ajax({
                type: "POST",
                url: "{{ url('/ujian/kepribadian/simpan-jawaban') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    id_soal: idSoal,
                    id_paket: idPaket,
                    jawaban1: (jawabanSiswa[idSoal].length >= 1) ? jawabanSiswa[idSoal][0] : null,
                    
                },
               
            });
        } else {
            // Jika belum dipilih, tambahkan ke daftar jawaban yang dipilih
            jawabanSiswa[idSoal].push(selectedOption);
            // Tambahkan kelas 'dijawab' untuk menandai jawaban yang dipilih
            $this.addClass('dijawab');
            // Ubah warna tombol menjadi hijau ketika dipilih
            $this.css('background-color', '#15C12C');
            
            // Ubah warna latar belakang tombol navigasi daftar soal menjadi hijau karena ada jawaban yang dipilih
            $('#nav' + idSoal).find('button').css({
                "background-color": "#15C12C",
				"color": "#fff",
                
            });
            // Kirim data ke controller menggunakan AJAX
            $.ajax({
                type: "POST",
                url: "{{ url('/ujian/kepribadian/simpan-jawaban') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    id_soal: idSoal,
                    id_paket: idPaket,
                    jawaban1: (jawabanSiswa[idSoal].length >= 1) ? jawabanSiswa[idSoal][0] : null,
     
                },
               
            });
        }
    } else {
        alert('Anda hanya bisa memilih dua jawaban.');
    }
});
})

</script>


</body>
</html>
