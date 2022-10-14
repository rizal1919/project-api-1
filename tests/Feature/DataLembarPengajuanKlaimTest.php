<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DataLembarPengajuanKlaimTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    public function test_example(){

        //{BASE URL}/{Service Name}/LPK/TglMasuk/{Parameter 1}/JnsPelayanan/{Paramater 2}

        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/LPK/TglMasuk/2022-10-1/JnsPelayanan/1';
        $content = 'application/json';
        
        $result = $this->getRequest($url, $content);
        // var_dump($result);
       
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);

       
        $this->assertTrue(true);
    }
}
