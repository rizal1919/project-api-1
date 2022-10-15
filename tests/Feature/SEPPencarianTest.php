<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SEPPencarianTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    

    public function test_example()
    {
        //{BASE URL}/{Service Name}/SEP/{parameter}
        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/SEP/0301R0110521V000037';
        $content = "Application/x-www-form-urlencoded";
   
        $result = $this->getRequest($url, $content);
        // var_dump($result);
        
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);

       
        $this->assertTrue(true);
    }
}
