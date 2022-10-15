<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PRBInsertTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    public function test_example()
    {
        //{BASE URL}/{Service Name}/PRB/insert

        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/PRB/insert';
        $content = "Application/x-www-form-urlencoded";
        


        // Setup request to send json via POST
        $data = array(

            "t_prb" => 
            [  
              "noSep" => "1101R0070118V999006",
              "noKartu" => "0009999979951",
              "alamat" => "Jln. Medan Merdekah",
              "email" => "email@gmail.com",
              "programPRB" => "09",
              "kodeDPJP" => "27590",
              "keterangan" => "Kecapekan kerja",
              "saran" => "Pasien harus olahraga bersama setiap minggu dan cuti, edukasi agar jangan disuruh kerja terus, lama lama stress.",
              "user" => "1234567",
              "obat" => 
                [
                    [ 
                        "kdObat" => "00196120124",
                        "signa1" => "1",
                        "signa2" => "1",
                        "jmlObat" => "11"
                    ],
                    [ 
                        "kdObat" => "00011220018",
                        "signa1" => "1",
                        "signa2" => "1",
                        "jmlObat" => "10"
                    ]
                ]      
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
