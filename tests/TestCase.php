<?php

namespace Tests;

use App\Models\Advertiser;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public $advertiserId;
    public function setUp():void
    {
        parent::setUp();
        Artisan::call('migrate:refresh --seed');
        $this->advertiserId=Advertiser::all()->first()->id;
    }

}
