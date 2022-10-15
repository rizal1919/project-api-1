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
        $url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/referensi/faskes/00161002/1";
        $content = 'application/json; charset=utf-8';

        $result = $this->getRequest($url, $content);
        // var_dump($result);

        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);
        $this->assertTrue(true);

    }
}
