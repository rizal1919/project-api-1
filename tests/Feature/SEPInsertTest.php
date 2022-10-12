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
    public function stringDecrypt($key, $string){
        
    
        $encrypt_method = 'AES-256-CBC';

        // hash
        $key_hash = hex2bin(hash('sha256', $key));
    
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
    
        return $output;
    }

    public function decompress($string){
    
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);

    }

    public function test_example()
    {
        //{BASE URL}/{Service Name}/SEP/2.0/insert

        $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/SEP/2.0/insert';
        

        // Computes the timestamp
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));

        // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $this->const_id."&".$tStamp, $this->secret_id, true);
        
        // key to decrypted
        $key = $this->const_id . $this->secret_id . $tStamp;

        // base64 encode�
        $encodedSignature = base64_encode($signature);

        $headers = array(
            "x-cons-id: " . $this->const_id . "",
            "x-timestamp: " . $tStamp . "",
            "x-signature:" . $encodedSignature ."",
            'user_key: ' . $this->user_key . '',
            "Content-Type:Application/x-www-form-urlencoded",
        );
        
        // open curl connection
        $ch = curl_init();
       

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
        $payload = json_encode($data);
        
        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        $data = curl_exec($ch);
        // var_dump($data);

        $result = json_decode($data);
        // var_dump($result);
        // echo $result;
        $result = $this->stringDecrypt($key, $result->response);
        // print_r($result);
        $result = $this->decompress($result);

       
        $this->assertTrue(true);
    }
}
