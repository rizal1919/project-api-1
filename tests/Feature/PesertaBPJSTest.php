<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PesertaBPJSTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
         //{Base URL}/{Service Name}/Peserta/nokartu/{parameter 1}/tglSEP/{parameter 2}
         $url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/Peserta/nokartu/0000079979951/tglSEP/2016-10-01";
         $content = "application/json; charset=utf-8";
        
         $result = $this->getRequest($url, $content);
         // var_dump($result);

         $result = $this->stringDecrypt($this->getKey(), $result->response);
         $result = $this->decompress($result);
         $this->assertTrue(true);
    }
}
