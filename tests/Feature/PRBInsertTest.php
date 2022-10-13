<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PRBInsertTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
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

    public function test_example()
    {
        //{BASE URL}/{Service Name}/PRB/insert

        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/PRB/insert';
        

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
            "Content-Type:Application/x-www-form-urlencoded",
        );
        
        // open curl connection
        $ch = curl_init();
       

        // Setup request to send json via POST
        $data = array(

            "t_prb" => 
            [  
              "noSep" => "1101R0070118V999006",
              "noKartu" => "0009999979951",
              "alamat" => "Jln. Medan Merdekah",
              "email" => "email@gmail.com",
              "programPRB" => "09",
              "kodeDPJP" => "27590",
              "keterangan" => "Kecapekan kerja",
              "saran" => "Pasien harus olahraga bersama setiap minggu dan cuti, edukasi agar jangan disuruh kerja terus, lama lama stress.",
              "user" => "1234567",
              "obat" => 
                [
                    [ 
                        "kdObat" => "00196120124",
                        "signa1" => "1",
                        "signa2" => "1",
                        "jmlObat" => "11"
                    ],
                    [ 
                        "kdObat" => "00011220018",
                        "signa1" => "1",
                        "signa2" => "1",
                        "jmlObat" => "10"
                    ]
                ]      
            ]
         );
        $payload = json_encode(array('request' => $data));
        
        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        $data = curl_exec($ch);
        // var_dump($data);

        $result = json_decode($data);
        var_dump($result);
        // echo $result;
        // print_r($result);
        $result = $this->stringDecrypt($key, $result->response);
        $result = $this->decompress($result);

       
        $this->assertTrue(true);
    }
}
