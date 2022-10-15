<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SEPUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
   
    public function test_example()
    {
        //{BASE URL}/{Service Name}/SEP/2.0/update

        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/SEP/2.0/update';
        $content = "Application/x-www-form-urlencoded";

        
        // Setup request to send json via POST
        $data = array(

            "t_sep" => [
                "noSep" => "1320R00205160000823",
                "klsRawat" =>[
                                "klsRawatHak" =>"",
                                "klsRawatNaik" =>"",
                                "pembiayaan" =>"",
                                "penanggungJawab" =>""
                              ],
                "noMR" => "00469120",
                "catatan" => "",
                "diagAwal" => "E10",
                "poli" => [
                        "tujuan" => "IGD",
                        "eksekutif" => "0"
                ],
                "cob" => [
                        "cob" => "0"
                ],
                "katarak" => [
                        "katarak" => "0"
                ],
                "jaminan" => [
                        "lakaLantas" => "0",
                        "penjamin" => [
                                "tglKejadian" => "",
                                "keterangan" => "",
                                "suplesi" => [
                                        "suplesi" => "0",
                                        "noSepSuplesi" => "",
                                        "lokasiLaka" => [
                                                "kdPropinsi" => "",
                                                "kdKabupaten" => "",
                                                "kdKecamatan" => ""
                                        ]
                                ]
                        ]
                ],
                "dpjpLayan" =>"46",
                "noTelp" => "08522038363",
                "user" => "Cobaws"
            ]
         );
        $payload = json_encode(array('request' => $data));
        
        $result = $this->putRequest($url, $content, $payload);
        // var_dump($result);
        
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        $result = $this->decompress($result);

       
        $this->assertTrue(true);
    }
}
