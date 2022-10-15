<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KecamatanTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        //{Base URL}/{Service Name}/referensi/kecamatan/kabupaten/{paramater 1}
        $url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/referensi/kecamatan/kabupaten/3139";
        $content = 'application/json; charset=utf-8';

        $result = $this->getRequest($url, $content);
        // var_dump($result);
        
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);
        $this->assertTrue(true);
    }
}
