<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DiagnosaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

   
    public function test_example()
    {

        $result = $this->config("https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/referensi/diagnosa/A04");
        // echo $this->decompress($result);

        $this->assertTrue(true);
    }
}