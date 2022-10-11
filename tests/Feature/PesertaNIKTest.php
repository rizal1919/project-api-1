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

        $result = $this->config("https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/Peserta/nik/3525151906990001/tglSEP/2016-10-01");
        //  echo $result;
        //  echo $this->decompress($result);
         $this->assertTrue(true);

    }
}
