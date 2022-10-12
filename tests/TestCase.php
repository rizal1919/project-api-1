<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $kodeppk = "0193R004"; 
    public $const_id = "5306";
    public $secret_id = "8wXDF487C5";
    public $user_key = "ddef85ffc09e7fe7ef5b480b02fb967f";
    

    public function stringDecrypt($key, $string){
        
    
        $encrypt_method = 'AES-256-CBC';

        // hash
        $key_hash = hex2bin(hash('sha256', $key));
    
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
    
        return $output;
    }

    public function decompress($string){
    
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);

    }

    public function config($url){

        $this->url = $url;

        // Computes the timestamp
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));

        // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $this->const_id."&".$tStamp, $this->secret_id, true);
        
        // key to decrypted
        $key = $this->const_id . $this->secret_id . $tStamp;

        // base64 encode�
        $encodedSignature = base64_encode($signature);

        $headers = array(
            "x-cons-id: " . $this->const_id . "",
            "x-timestamp: " . $tStamp . "",
            "x-signature:" . $encodedSignature ."",
            'user_key: ' . $this->user_key . '',
            "Content-Type:application/json; charset=utf-8",
        );
        
        // open curl connection
        $ch = curl_init();
        // // set url 
        curl_setopt($ch, CURLOPT_URL, $this->url); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        $data = curl_exec($ch);
        // echo $data;

        $result = json_decode($data);
        // print_r($result);
        
        $result = $this->stringDecrypt($key, $result->response);
        $result = $this->decompress($result);

        return $result;
    }
}
