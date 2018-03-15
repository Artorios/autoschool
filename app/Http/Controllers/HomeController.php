<?php

namespace App\Http\Controllers;

use App\Models\Location\City;
use App\Models\Location\PriceCity;
use App\Models\Location\Region;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.main', compact('regions'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRegionPrices()
    {
        $regions = Region::with('citiesMain')->whereHas('citiesMain')->get();

        //dd($regions->toArray());

        return response()->json(['regions' => $regions], 200);
    }

    /**
     * @param Request $request
     */
    public function testKassa(Request $request)
    {
        $url  = $request->input('url');
        $data = $request->input('data');

        $connect = new Client([
            'headers'         => [
                'Accept-encoding' => 'gzip',
                'Accept'          => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language' => 'ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
                'Cache-Control'   => 'max-age=0',
                'Connection'      => 'keep-alive',
                'User-Agent'      => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'
            ],
            'http_errors'     => false,
            'connect_timeout' => 10
        ]);

        var_dump($_SERVER, $url);

        $response = $connect->get($url,$data);

        dd($response->getStatusCode());
    }
}
