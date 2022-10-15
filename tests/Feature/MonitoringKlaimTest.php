<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MonitoringKlaimTest extends TestCase
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
        //{Base URL}/{Service Name}/Monitoring/Klaim/Tanggal/{Parameter 1}/JnsPelayanan/{Parameter 2}/Status/{Parameter 3}

        $url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/Monitoring/Klaim/Tanggal/2017-09-02/JnsPelayanan/1/Status/3";
        $content = "application/json; charset=utf-8";

        $result = $this->getRequest($url, $content);
        // var_dump($result);
       
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);
        $this->assertTrue(true);
    }
}
