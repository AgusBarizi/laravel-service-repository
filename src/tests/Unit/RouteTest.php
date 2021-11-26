<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * vendor/bin/phpunit --filter RouteTest
     *
     * @return void
     */
    public function test_ping()
    {
        $res = $this->get("/api/ping")->assertStatus(201);
        $this->assertTrue(true);
        // $data = [
        //     "name"=>"Agus"
        // ];
        // \dd($data);
    }
}
