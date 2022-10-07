<?php

namespace Tests\Feature;


// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Http;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public $kodeppk = "0193R004"; 
    public $const_id = "5306";
    public $secret_id = "8wXDF487C5";
    public $user_key = "ddef85ffc09e7fe7ef5b480b02fb967f";
    public $url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/referensi/propinsi";

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

    

    public function test_the_application_returns_a_successful_response()
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);
        
        $uri= $this->url;
        
       
        $data = $this->const_id;
        $secretKey = $this->secret_id;
              // Computes the timestamp
               date_default_timezone_set('UTC');
               $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
        // var_dump($signature);

        $key = $data . $secretKey . $tStamp;

        
        // base64 encode�
        $encodedSignature = base64_encode($signature);
        // $encodedAuthorization = base64_encode($pcareUname.':'.$pcarePWD.':'.$kdAplikasi);
        

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


        // $response = $this->withHeaders([
        //     "Content-Type" => "application/json",
        //     "X-cons-id" => $data,
        //     "X-timestamp" => $tStamp,
        //     "X-signature" => $encodedSignature
        // ])->get($uri, $json);
      
       
        $ch = curl_init();
        $headers = array(
            "x-cons-id: " . $data . "",
            "x-timestamp: " . $tStamp . "",
            "x-signature:" . $encodedSignature ."",
            'user_key: ' . $this->user_key . '',
            "Content-Type:application/json",

        );

        // // set url 
        curl_setopt($ch, CURLOPT_URL, $uri); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        // curl_setopt($curl, CURLOPT_POST, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        $data = curl_exec($ch);
        // echo $data;
    
        $result = json_decode($data);
        $result = $this->stringDecrypt($key, $result->response);   
        echo $this->decompress($result);

        

        
        
        
    }
}
