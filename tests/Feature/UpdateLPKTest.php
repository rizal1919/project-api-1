<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateLPKTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
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

    public function test_example()
    {

        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/LPK/update';
        $content = "Application/x-www-form-urlencoded";
        

        
        // Setup request to send json via POST
        $data = array(

                "t_lpk"=> [
                    "noSep" => "1320R00205160000823",
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
        $result = $this->putRequest($url, $content, $payload);
        // var_dump($result);

        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);

       
        $this->assertTrue(true);
    }
}
