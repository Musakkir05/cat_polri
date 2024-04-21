@if(session()->has('alert'))
    <script>
        Swal.fire({
            title: "{{ session('alert') }}",
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    </script>
@endif
@if(isset($petunjuk))
<script>
    var petunjukId = {{ $petunjuk->id }};
    var waktuB = {{$petunjuk->waktu}};
</script>
@endif
<div id="wrap-soal">
    <input type="hidden" value="{{$petunjuk->id}}" name="petunjuk">
    <div class="instruksi-container">
        <h6>Petunjuk</h6>
        {!! $petunjuk
        ->soal !!}
    </div>

    <div>
        <div class="pertanyaan-container">
            <h6>Pertanyaan</h6>
            {!! $soal['soal'] !!}
            <div class="pilihan">
                <button class="pilihan-btn"  id_instruksi="{{$soal->id_instruksi}}"
                    id_pertanyaan="{{$soal->id}}" data-answer="A">A</button>
                <button class="pilihan-btn"id_instruksi="{{$soal->id_instruksi}}"
                    id_pertanyaan="{{$soal->id}}" data-answer="B">B</button>
                <button class="pilihan-btn" id_instruksi="{{$soal->id_instruksi}}"
                    id_pertanyaan="{{$soal->id}}" data-answer="C">C</button>
                <button class="pilihan-btn" id_instruksi="{{$soal->id_instruksi}}"
                    id_pertanyaan="{{$soal->id}}" data-answer="D">D</button>
                <button class="pilihan-btn" id_instruksi="{{$soal->id_instruksi}}"
                    id_pertanyaan="{{$soal->id}}" data-answer="E">E</button>
            </div>
        </div>
    </div>

</div>


