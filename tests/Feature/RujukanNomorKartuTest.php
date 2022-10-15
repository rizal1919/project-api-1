<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RujukanNomorKartuTest extends TestCase
{
    
    public function test_example(){
        //{BASE URL}/{Service Name}/Rujukan/Peserta/{parameter}

        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/Rujukan/Peserta/0002040298097';
        $content = "application/json; charset=utf-8";

        $result = $this->getRequest($url, $content);
        // print_r($result);

        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);
        $this->assertTrue(true);
    }
}
