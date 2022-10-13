<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MonitoringDataKunjunganTest extends TestCase
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
        //{Base URL}/{Service Name}/Monitoring/Kunjungan/Tanggal/{Parameter 1}/JnsPelayanan/{Parameter 2}
        $url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/Monitoring/Kunjungan/Tanggal/2017-10-01/JnsPelayanan/2";
        

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
            "Content-Type: application/json; charset=utf-8",
        );
        
        // open curl connection
        $ch = curl_init();
       

        // Setup request to send json via POST
        $data = array(

                "t_lpk"=> [

                    "noSep" => "0301R0011017V000015",
                    "tglMasuk" => "2017-10-30",
                    "tglKeluar" => "2017-10-30",
                    "jaminan" => "1",
                    "poli" => [
                        "poli" => "INT"
                    ],
                    "perawatan" => [
                        "ruangRawat" => "1",
                        "kelasRawat" => "1",
                        "spesialistik" => "1",
                        "caraKeluar" => "1",
                        "kondisiPulang" => "1"
                    ],
                    "diagnosa" => [
                        [
                           "kode" => "N88.0",
                           "level" => "1"
                        ],
                        [
                           "kode" => "A00.1",
                           "level" => "2"
                        ]
                    ],
                    "procedure" => [
                        [
                           "kode" => "00.82"
                        ],
                        [
                           "kode" => "00.83"
                        ]
                    ],
                    "rencanaTL" => [
                        "tindakLanjut" => "1",
                        "dirujukKe" => [
                           "kodePPK" => ""
                        ],
                        "kontrolKembali" => [
                           "tglKontrol" => "2017-11-10",
                           "poli" => ""
                        ]
                    ],
                    "DPJP"=> "3",
                    "user" => "Coba Ws"
                ]
         );
        $payload = json_encode(array('request' => $data));
        //  print_r($payload);
        // var_dump($payload);
        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        $data = curl_exec($ch);
        // var_dump($data);

        $result = json_decode($data);
        // var_dump($result);
        // echo $result;
        // print_r($result);
        $result = $this->stringDecrypt($key, $result->response);
        $result = $this->decompress($result);

       
        $this->assertTrue(true);
    }
}
