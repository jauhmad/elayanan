<?php

function my_crypt( $string, $action ) {
    // you may change these values to your own
    $secret_key = date('Ymd');
    $secret_iv = date('dmY');
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
    if( $action == 'e' ) { //encrypt
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    elseif( $action == 'd' ){ //decrypt
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
    return $output;
}

function tgl_format_indo($tgl){
    if($tgl=='0000-00-00' || $tgl=='') 
        return '-';
    else
        return date("d-m-Y", strtotime($tgl));
        
}

function tgl_format_itl($tgl){
    if($tgl=='00-00-0000' || $tgl=='') 
        return '-';
    else
        return date("Y-m-d", strtotime($tgl));
        
}