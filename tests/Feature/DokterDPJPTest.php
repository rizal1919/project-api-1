<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DokterDPJPTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        //{Base URL}/{Service Name}/referensi/dokter/pelayanan/{Parameter 1}/tglPelayanan/{Parameter 2}/Spesialis/{Parameter 3}
        $url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev//referensi/dokter/pelayanan/1/tglPelayanan/2016-06-12/Spesialis/31486";
        $content = "application/json; charset=utf-8";

        $result = $this->getRequest($url, $content);
        // var_dump($result);
        
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);
        $this->assertTrue(true);
    }
}
