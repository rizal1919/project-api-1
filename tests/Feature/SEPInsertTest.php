<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SEPInsertTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    public function test_example()
    {
        //{BASE URL}/{Service Name}/SEP/2.0/insert

        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/SEP/2.0/insert';
        $content = "Application/x-www-form-urlencoded";
       
        // Setup request to send json via POST
        $data = array(

            "t_sep" => [
                "noKartu" => "0001105689835",
                "tglSep" => "2021-07-30",
                "ppkPelayanan" => "0301R011",
                "jnsPelayanan" => "1",
                "klsRawat" => [
                   "klsRawatHak" => "2",
                   "klsRawatNaik" => "1",
                   "pembiayaan" => "1",
                   "penanggungJawab" => "Pribadi"
                ],
                "noMR" => "MR9835",
                "rujukan" => [
                   "asalRujukan" => "2",
                   "tglRujukan" => "2021-07-23",
                   "noRujukan" => "RJKMR9835001",
                   "ppkRujukan" => "0301R011"
                ],
                "catatan" => "testinsert RI",
                "diagAwal" => "E10",
                "poli" => [
                   "tujuan" => "",
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
                   "noLP" => "12345",
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
                "tujuanKunj" => "0",
                "flagProcedure" => "",
                "kdPenunjang" => "",
                "assesmentPel" => "",
                "skdp" => [
                   "noSurat" => "0301R0110721K000021",
                   "kodeDPJP" => "31574"
                ],
                "dpjpLayan" => "",
                "noTelp" => "081111111101",
                "user" => "Coba Ws"
             ]

         );
        $payload = json_encode(array("request" => $data));
        $result = $this->postRequest($url, $content, $payload);
      //   var_dump($result);
        
        $result = $this->stringDecrypt($this->getKey(), $result->response);
        // print_r($result);
        $result = $this->decompress($result);

       
        $this->assertTrue(true);
    }
}
