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
    

    

    public function test_example()
    {
        //{Base URL}/{Service Name}/Monitoring/Kunjungan/Tanggal/{Parameter 1}/JnsPelayanan/{Parameter 2}
        $url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/Monitoring/Kunjungan/Tanggal/2017-10-01/JnsPelayanan/2";
        $content = "application/json; charset=utf-8";

        $result = $this->getRequest($url, $content);
        // print_r($result);
        
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);
        $this->assertTrue(true);
    }
}
