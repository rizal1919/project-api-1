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

        $result = $this->config("https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev//referensi/dokter/pelayanan/1/tglPelayanan/2016-06-12/Spesialis/31486");
        // print_r($result);
        //  echo $this->decompress($result);
         $this->assertTrue(true);
    }
}
