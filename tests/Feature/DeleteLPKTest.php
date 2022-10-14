<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteLPKTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    public function test_example(){

        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/LPK/delete';
        $content = 'Application/x-www-form-urlencoded';

        // Setup request to send json via POST
        $data = array(

                "t_lpk"=> [

                    "noSep" => "1320R00205160000823",
                    
                ]
         );
        $payload = json_encode(array('request' => $data));
        $result = $this->postRequest($url, $content, $payload);
        // var_dump($result);
       
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);

       
        $this->assertTrue(true);
    }
}
