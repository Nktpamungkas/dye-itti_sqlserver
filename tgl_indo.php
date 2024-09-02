<?php
function tanggal_indo($tanggal, $cetak_hari = false)
{
	$hari = array(
		1 => 'Senin',
		2 => 'Selasa',
		3 => 'Rabu',
		4 => 'Kamis',
		5 => 'Jumat',
		6 => 'Sabtu',
		7 => 'Minggu'
	);

	$bulan = array(
		1 => 'Januari',
		2 => 'Februari',
		3 => 'Maret',
		4 => 'April',
		5 => 'Mei',
		6 => 'Juni',
		7 => 'Juli',
		8 => 'Agustus',
		9 => 'September',
		10 => 'Oktober',
		11 => 'November',
		12 => 'Desember'
	);

	// Cek apakah $tanggal adalah objek DateTime
	if ($tanggal instanceof DateTime) {
		$tanggal = $tanggal->format('Y-m-d');
	}

	$split = explode('-', $tanggal);

	$tgl_indo = $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];

	if ($cetak_hari) {
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}

	return $tgl_indo;
}

function tgl_indo($tanggal)
{
	$bulan = array(
		1 => 'Januari',
		2 => 'Februari',
		3 => 'Maret',
		4 => 'April',
		5 => 'Mei',
		6 => 'Juni',
		7 => 'Juli',
		8 => 'Agustus',
		9 => 'September',
		10 => 'Oktober',
		11 => 'November',
		12 => 'Desember'
	);

	// Cek apakah $tanggal adalah objek DateTime
	if ($tanggal instanceof DateTime) {
		$tanggal = $tanggal->format('Y-m-d');
	}

	$pecahkan = explode('-', $tanggal);

	return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}
