
<?php

if ($jawaban) {
    if ($jawaban->pilihan1) {
        $jawaban_siswa1 = $jawaban->pilihan1;
    }
    if ($jawaban->pilihan1=='') {
        $jawaban_siswa1 = '';
    }
}
else {
    $jawaban_siswa1 = '';
}
?>

<span class="detail_soal_id" style="display: none;"></span>
<div class="question-container">
	<p id="no_soal_detail" class="question-number">{{$nomorSoal}}. </p>
	<div class="soal question-text">{!! $soal->soal !!}</div>

</div>

@if ($soal->pilA)
<button class="jawab {{ $jawaban_siswa1 == 'A' ? 'dijawab' : '' }}"
paket-id="{{ $soal->id_paket }}"
data-id="{{ $soal->id }}"
    data-jawab="A">
    <table width="100%">
        <tr>
            <td width="15px" valign="top"><span>A.</span></td>
            <td valign="top" class="pilihan">{!! $soal->pilA !!}</td>
        </tr>
    </table>
</button>
@endif

<?php if ($soal->pilB) {?>
	<button class="jawab {{ $jawaban_siswa1 == 'B' ? 'dijawab' : '' }}"
    paket-id="{{ $soal->id_paket }}"
    data-id="{{ $soal->id }}"
		data-jawab="B">
		<table width="100%">
			<tr>
				<td width="15px" valign="top"><span>B.</span></td>
				<td valign="top" class="pilihan">{!! $soal->pilB !!}</td>
			</tr>
		</table>
	</button>
<?php } ?>
<?php if ($soal->pilC) {?>
	<button class="jawab {{ $jawaban_siswa1 == 'C' ? 'dijawab' : '' }}"
	paket-id="{{ $soal->id_paket }}"
		data-id="{{ $soal->id }}"
		data-jawab="C">
		<table width="100%">
			<tr>
				<td width="15px" valign="top"><span>C.</span></td>
				<td valign="top" class="pilihan">{!! $soal->pilC !!}</td>
			</tr>
		</table>
	</button>
<?php } ?>
<?php if ($soal->pilD) {?>
	<button class="jawab {{ $jawaban_siswa1 == 'D' ? 'dijawab' : '' }}"
	paket-id="{{ $soal->id_paket }}"
		data-id="{{ $soal->id }}"
		data-jawab="D">
		<table width="100%">
			<tr>
				<td width="15px" valign="top"><span>D.</span></td>
				<td valign="top" class="pilihan">{!! $soal->pilD !!}</td>
			</tr>
		</table>
	</button>
<?php } ?>
