<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PesertaNIKTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        //{BASE URL}/{Service Name}/Peserta/nik/{parameter 1}/tglSEP/{parameter 2}
        $url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/Peserta/nik/3525151906990001/tglSEP/2016-10-01";
        $content = 'application/json; charset=utf-8';
        
        $result = $this->getRequest($url, $content);
        // print_r($result);
        
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);
        $this->assertTrue(true);

        // nik aktif 3601120705880002
        // nik non aktif premi 7271035011950007

    }
}
