<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SEPDeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function test_example()
    {
        //{BASE URL}/{Service Name}/SEP/2.0/delete
        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/SEP/2.0/delete';
        $content = "Application/x-www-form-urlencoded";
        
        // Setup request to send json via POST
        $data = array(

            "t_sep" => [
                "noSep" => "1320R00205160000823",
                "user" => "Coba Ws"
            ]

         );
        $payload = json_encode(array("request" => $data));
        
        $result = $this->deleteRequest($url, $content, $payload);
        // var_dump($result);
        // echo $result;
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        // print_r($result);
        $result = $this->decompress($result);

       
        $this->assertTrue(true);
    }
}
