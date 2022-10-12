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

         $result = $this->config("https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/Peserta/nokartu/0000079979951/tglSEP/2016-10-01");
        //  echo $result;
        //  echo $this->decompress($result);
         $this->assertTrue(true);
    }
}
