<?php

namespace App\Http\Controllers;

use App\UsdExchange;

class UsdExchangeController extends Controller
{
    static public function update() {
        $key = env('EXCHANGERATES_APP_ID');
        if (!$key) {
            return false;
        }
        $url = "https://openexchangerates.org/api/latest.json?app_id=".$key;
        $json = file_get_contents($url);
        $uahRate = json_decode($json)->rates->UAH;
        $eurRate = json_decode($json)->rates->EUR;
        $uah = UsdExchange::where('currency', 'UAH')->update(['sell' => $uahRate]);
        $eur = UsdExchange::where('currency', 'EUR')->update(['sell' => $eurRate]);
        return true;
    }

    static public function uahToUsd($uah) {
        return  round( $uah / UsdExchange::findOrFail(1)->sell, 2 );
    }

    static public function usdToUah($usd) {

    }
}
