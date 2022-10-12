<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatiIITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        //{Base URL}/{Service Name}/referensi/kabupaten/propinsi/{paramater 1}


        $result = $this->config("https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev//referensi/kabupaten/propinsi/0227");
        // print_r($result);
        //  echo $this->decompress($result);
         $this->assertTrue(true);
    }
}
