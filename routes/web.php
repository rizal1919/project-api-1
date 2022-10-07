<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api',  function(){
    
        $uri="https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/referensi/propinsi";
       
        $data = "5306";
        $secretKey = "8wXDF487C5";
              // Computes the timestamp
               date_default_timezone_set('UTC');
               $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
        // var_dump($signature);
        
        // base64 encode�
        $encodedSignature = base64_encode($signature);
        // $encodedAuthorization = base64_encode($pcareUname.':'.$pcarePWD.':'.$kdAplikasi);
        

        $json = [
            "kodekelas" => "VIP", 
            "koderuang" => "RG01", 
            "namaruang" => "Ruang Anggrek VIP", 
            "kapasitas" => "20", 
            "tersedia" => "10",
            "tersediapria" => "0", 
            "tersediawanita" => "0", 
            "tersediapriawanita" => "0"
        ];


        // $response = $this->withHeaders([
           
        // ])->get($uri, $json);
      
       
        $ch = curl_init();
        $headers = array(
            "X-cons-id: " . $data . "",
            "X-timestamp: " . $tStamp . "",
            "X-signature:" . $encodedSignature ."",
            "Content-Type: Application/json",
        );

        

        echo $data . "<br>";
        echo $tStamp . "<br>";
        echo $encodedSignature . "<br>";
        


        // // // set url 
        // curl_setopt($ch, CURLOPT_URL, $uri); 
        // curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        // $data = curl_exec($ch);
        // curl_close($ch);
        
        // $this->assertStatus(200);

        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', 'https://google.com', [
            'headers' => [
                // "Content-Type" => "application/json",
                "X-cons-id" => $data,
                "X-timestamp" => $tStamp,
                "X-signature" => $encodedSignature,
                'Accept'     => 'application/json',
            ],
        ]);

        // $res = Http::withHeaders([
        //     "X-cons-id" => $data,
        //     "X-timestamp" => $tStamp,
        //     "X-signature" => $encodedSignature,
        //     'Content-Type' => 'Application/x-www-form-urlencoded',
        // ])->get($uri);

        dd($res);

        // echo $res->getStatusCode();
        // // "200"
        // echo $res->getHeader('content-type')[0];
        // // 'application/json; charset=utf8'
        // echo $res->getBody();
        // // {"type":"User"...'

        
});
