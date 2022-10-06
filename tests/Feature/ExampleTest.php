<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);

        $uri="https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/aplicaresws/rest/bed/update/0193R004";
        
        $data = "5306";
        $secretKey = "8wXDF487C5";
              // Computes the timestamp
               date_default_timezone_set('UTC');
               $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
        
        // base64 encode�
        $encodedSignature = base64_encode($signature);
        
        // urlencode�
        // $encodedSignature = urlencode($encodedSignature);
        echo "\n";
        echo "X-cons-id: " .$data ." \n";
        echo "X-timestamp:" .$tStamp ." \n";
        echo "X-signature: " .$encodedSignature;

        $headers = array( 
            "Accept: application/json", 
            "X-cons-id:".$data ." ", 
            "X-timestamp: ".$tStamp ." ", 
            "X-signature: ".$encodedSignature
        ); 


        // 
        // $ch = curl_init();

        // // set url 
        // curl_setopt($ch, CURLOPT_URL, $uri); 
        // curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        // $data = curl_exec($ch);
        
        // curl_close($ch);
        
        // kode ppk : 0193R004 
        // const id : 5306
        // sec id : 8wXDF487C5
        // user key : ddef85ffc09e7fe7ef5b480b02fb967f
    }
}
