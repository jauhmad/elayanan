<?php
//define('CURLE_OPERATION_TIMEDOUT', 28);
//https://www.rumahcode.org/57/Codeigniter-4-Membuat-Helper-Sendiri
function pegawaiPerSKPD($skpd, $level){

	if($level=='adminskpd') {
		 $field='skpd%3D'.$skpd;
		 $url= 'pegawai_per_skpd';
	}elseif($level=='adminuker'){
	     $field='uker%3D'.$skpd;
	     $url= 'pegawai_per_unit_kerja';
	}elseif($level=='adminsatker'){
	     $field='satker%3D'.$skpd;
	     $url= 'pegawai_per_satuan_kerja';
	} 

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://gsb.kulonprogokab.go.id/auth/simasneg/'.$url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => 'field=sim%3Dsimasneg%26pass%3D15987532147%26aksi%3Dview%26'.$field.'%26user%3Dapisimasneg',
	  CURLOPT_HTTPHEADER => array(
	    'Authorization: Basic ZWxheWFuYW46NXJ3ZTYzNnRndDckM3Ih' //elayanan
	  ),
	));

	$response = curl_exec($curl);
	
	if (curl_errno($curl) === CURLE_OPERATION_TIMEDOUT) {
    	return 'Time out';
	}else{
		curl_close($curl);
		return $response;
    }
}

function pegawaiBiodata($nip){
	$curl = curl_init();

	  curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://gsb.kulonprogokab.go.id/auth/simasneg/pegawai_biodata/',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => array('field' => 'sim=simasneg&user=apibiodata&pass=15987532147&aksi=view&nip='.$nip),
	  CURLOPT_HTTPHEADER => array(
	    'Authorization: Basic ZWxheWFuYW46d2VyMzRnMzY3cThlcXdxZDUlOTM5' //elayanan
	  ),
	));


	$response = curl_exec($curl);

	if (curl_errno($curl) === CURLE_OPERATION_TIMEDOUT) {
    	return 'Time out';
	}else{
		curl_close($curl);
		return $response;
    }
}

function pegawaiRiwayatGolru($nip){
	$curl = curl_init();

	 curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://gsb.kulonprogokab.go.id/auth/simasneg/riwayat_golru',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'field=sim%3Dsimasneg%26user%3Dapiriwayatgolru%26pass%3D15987532147%26aksi%3Dview%26nip%3D'.$nip,
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic ZWxheWFuYW46NXJ3ZTYzNnRndDckM3Ih'
  ),
));


	$response = curl_exec($curl);

	if (curl_errno($curl) === CURLE_OPERATION_TIMEDOUT) {
    	return 'Time out';
	}else{
		curl_close($curl);
		return $response;
    }
}

function pegawaiRiwayatJbt($nip,$tahun){
	$curl = curl_init();

	  curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://gsb.kulonprogokab.go.id/auth/simasneg/riwayat_jabatan/',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => array('field' => 'sim=simasneg&user=apiriwayatjabatan&pass=15987532147&aksi=view&nip='.$nip.'&tahun='.$tahun),
	  CURLOPT_HTTPHEADER => array(
	    'Authorization: Basic ZWxheWFuYW46NXJ3ZTYzNnRndDckM3Ih'
	  ),
	));


	$response = curl_exec($curl);

	if (curl_errno($curl) === CURLE_OPERATION_TIMEDOUT) {
    	return 'Time out';
	}else{
		curl_close($curl);
		return $response;
    }
}


function profilOPD(){
	$curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://gsb.kulonprogokab.go.id/auth/suratku/list_opd/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic ZWxheWFuYW46NXJ3ZTYzNnRndDckM3Ih'
  ),
));


	$response = curl_exec($curl);

	if (curl_errno($curl) === CURLE_OPERATION_TIMEDOUT) {
    	return 'Time out';
	}else{
		curl_close($curl);
		return $response;
    }
}