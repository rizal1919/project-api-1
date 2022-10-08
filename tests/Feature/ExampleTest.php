<?php

namespace Tests\Feature;


// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Http;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public $url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/referensi/propinsi";

    public function test_the_application_returns_a_successful_response()
    {
        
        $result = $this->config("https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/referensi/propinsi");
        // echo $this->decompress($result);
        $this->assertTrue(true);
        
        
        
    }
}
