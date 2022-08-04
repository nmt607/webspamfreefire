<?php

namespace App\Traits;

use Ixudra\Curl\Facades\Curl;

trait ValidateTrait
{
    public function validateAccount($account)
    {
        $res = Curl::to('https://www.facebook.com/ajax/login/help/identify.php')
            ->withHeaders([
                'authority: www.facebook.com',
                'x-fb-lsd: dvvdv',
                'content-type: application/x-www-form-urlencoded',
                'accept: */*',
                'origin: https://www.facebook.com',
                'sec-fetch-site: same-origin',
                'sec-fetch-mode:cors',
                'sec-fetch-dest:empty',
                'accept-language: en-US,en;q=0.9',
                'user-agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36'
            ])
            ->withData([
                'lsd' => 'dvvdv',
                'email' => $account,
                '__a' => rand(1, 10)
            ])
            ->withProxy('45.145.57.229', 11664, 'https://', 'B54v5f', 'gqmjos')          
            ->post();
        if (str_contains($res, 'window.location.href')) {
            return true;
        } else {
            return false;
        }
    }
}
