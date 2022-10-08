<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Symfony\Component\VarDumper\VarDumper;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});





Route::get('/api',  function(){

        function decompress($string){
        
            return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);

        }

        function stringDecrypt($key, $string){
            
        
            $encrypt_method = 'AES-256-CBC';

            // hash
            $key_hash = hex2bin(hash('sha256', $key));
        
            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        
            return $output;
        } 

        $kodeppk = "0193R004"; 
        $const_id = "5306";
        $secret_id = "8wXDF487C5";
        $user_key = "ddef85ffc09e7fe7ef5b480b02fb967f";
        $url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/referensi/propinsi";


        $uri="https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/referensi/propinsi";
       
        $data = "5306";
        $secretKey = "8wXDF487C5";
              // Computes the timestamp
               date_default_timezone_set('UTC');
               $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
        // var_dump($signature);
        
        // base64 encode�
        $encodedSignature = base64_encode($signature);
        // $encodedAuthorization = base64_encode($pcareUname.':'.$pcarePWD.':'.$kdAplikasi);
        
        $key = $data . $secretKey . $tStamp;

        $json = [
            "kodekelas" => "VIP", 
            "koderuang" => "RG01", 
            "namaruang" => "Ruang Anggrek VIP", 
            "kapasitas" => "20", 
            "tersedia" => "10",
            "tersediapria" => "0", 
            "tersediawanita" => "0", 
            "tersediapriawanita" => "0"
        ];

        $ch = curl_init();
        $headers = array(
            "X-cons-id: " . $data . "",
            "X-timestamp: " . $tStamp . "",
            "X-signature:" . $encodedSignature ."",
            'user_key:' . $user_key,
            "Content-Type: application/json",
        );

        

        echo $data . "<br>";
        echo $tStamp . "<br>";
        echo $encodedSignature . "<br>";
        

        // // set url 
        curl_setopt($ch, CURLOPT_URL, $uri); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        $data = curl_exec($ch);
        $result = json_decode($data);
        $result = stringDecrypt($key, $result->response);   
        $result = decompress($result);
        $result = json_decode($result);

        echo dd($result->list[0]->kode);

        


        
});
