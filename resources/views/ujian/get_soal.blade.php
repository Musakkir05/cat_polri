
<?php

if ($jawaban) {
    if ($jawaban->pilihan1) {
        $jawaban_siswa1 = $jawaban->pilihan1;
    }
    if ($jawaban->pilihan2) {
        $jawaban_siswa2 = $jawaban->pilihan2;
    }
    if ($jawaban->pilihan2=='') {
        $jawaban_siswa2 = '';
    }
    if ($jawaban->pilihan1=='') {
        $jawaban_siswa1 = '';
    }
}
else {
    $jawaban_siswa1 = '';
    $jawaban_siswa2 = '';
}
?>

<span class="detail_soal_id" style="display: none;"></span>
<div class="question-container">
	<p id="no_soal_detail" class="question-number">{{$nomorSoal}}. </p>
	<div class="soal question-text">{!! $soal->soal !!}</div>

</div>

@if ($soal->pilA)
<div class="jawab {{ $jawaban_siswa1 == 'A' || $jawaban_siswa2 == 'A' ? 'dijawab' : '' }}"
paket-id="{{ $soal->id_paket }}"
data-id="{{ $soal->id }}"
    data-jawab="A">
    <table width="100%">
        <tr>
            <td width="15px" valign="top"><span>A.</span></td>
            <td valign="top" class="pilihan">{!! $soal->pilA !!}</td>
        </tr>
    </table>
</div>
@endif

<?php if ($soal->pilB) {?>
	<div class="jawab {{ $jawaban_siswa1 == 'B' || $jawaban_siswa2 == 'B' ? 'dijawab' : '' }}"
    paket-id="{{ $soal->id_paket }}"
    data-id="{{ $soal->id }}"
		data-jawab="B">
		<table width="100%">
			<tr>
				<td width="15px" valign="top"><span>B.</span></td>
				<td valign="top" class="pilihan">{!! $soal->pilB !!}</td>
			</tr>
		</table>
	</div>
<?php } ?>
<?php if ($soal->pilC) {?>
	<div class="jawab {{ $jawaban_siswa1 == 'C' || $jawaban_siswa2 == 'C' ? 'dijawab' : '' }}"
	paket-id="{{ $soal->id_paket }}"
		data-id="{{ $soal->id }}"
		data-jawab="C">
		<table width="100%">
			<tr>
				<td width="15px" valign="top"><span>C.</span></td>
				<td valign="top" class="pilihan">{!! $soal->pilC !!}</td>
			</tr>
		</table>
	</div>
<?php } ?>
<?php if ($soal->pilD) {?>
	<div class="jawab {{ $jawaban_siswa1 == 'D' || $jawaban_siswa2 == 'D' ? 'dijawab' : '' }}"
	paket-id="{{ $soal->id_paket }}"
		data-id="{{ $soal->id }}"
		data-jawab="D">
		<table width="100%">
			<tr>
				<td width="15px" valign="top"><span>D.</span></td>
				<td valign="top" class="pilihan">{!! $soal->pilD !!}</td>
			</tr>
		</table>
	</div>
<?php } ?>
<?php if ($soal->pilE) {?>
	<div class="jawab {{ $jawaban_siswa1 == 'E' || $jawaban_siswa2 == 'E' ? 'dijawab' : '' }}"
		paket-id="{{ $soal->id_paket }}"
		data-id="{{ $soal->id }}"
		data-jawab="E">
		<table width="100%">
			<tr>
				<td width="15px" valign="top"><span>E.</span></td>
				<td valign="top" class="pilihan">{!! $soal->pilE !!}</td>
			</tr>
		</table>
	</div>
<?php } ?>