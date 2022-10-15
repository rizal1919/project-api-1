<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SEPPencarianInternalTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    public function test_example()
    {
        //{BASE URL}/{Service Name}/SEP/Internal/{parameter 1}

        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/SEP/Internal/0905R0031020V000397';
        $content = "Application/x-www-form-urlencoded";

        $result = $this->getRequest($url, $content);
        // var_dump($result);
        
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);

       
        $this->assertTrue(true);
    }
}
