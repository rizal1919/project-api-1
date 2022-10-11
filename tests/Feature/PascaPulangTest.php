<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PascaPulangTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        //{Base URL}/{Service Name}/referensi/pascapulang

        $result = $this->config("https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/referensi/pascapulang");
        // print_r($this->decompress($result));

        $this->assertTrue(true);
    }
}
