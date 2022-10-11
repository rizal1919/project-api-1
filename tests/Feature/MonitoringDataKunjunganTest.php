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

        $result = $this->config("https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/Monitoring/Kunjungan/Tanggal/2022-10-01/JnsPelayanan/Inap");
        $result = $this->decompress($result);
        // print_r($result);

        $this->assertTrue(true);
    }
}
