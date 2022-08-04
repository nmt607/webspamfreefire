<?php

namespace App\Http\Controllers;

use GeoIp2\Record\Location;
use Illuminate\Http\Request;
use App\Traits\ValidateTrait;
use Ixudra\Curl\Facades\Curl;

class TestController extends Controller
{
    use ValidateTrait;

    public function index(Request $request)
    {
        $res = $this->validateAccount('sonsoixam@icloud.com');
        dd($res);

    }
}
