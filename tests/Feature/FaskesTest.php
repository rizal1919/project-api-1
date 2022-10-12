<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FaskesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        
        //{Base URL}/{Service Name}/referensi/faskes/{Parameter 1}/{Parameter 2}

        $result = $this->config("https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/referensi/faskes/00161002/1");
        // var_dump($result);
        // echo $this->decompress($result);

        $this->assertTrue(true);
    }
}
