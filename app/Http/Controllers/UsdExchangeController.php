<?php

namespace App\Http\Controllers;

use App\UsdExchange;

class UsdExchangeController extends Controller
{
    static public function update() {
        $key = env('EXCHANGERATES_APP_ID');
        $url = "https://openexchangerates.org/api/latest.json?app_id=".$key;
        $json = '{
            "disclaimer": "Usage subject to terms: https://openexchangerates.org/terms",
            "license": "https://openexchangerates.org/license",
            "timestamp": 1599048000,
            "base": "USD",
            "rates": {
                "AED": 3.672949,
                "AFN": 76.81965,
                "ALL": 104.645125,
                "AMD": 481.616228,
                "ANG": 1.794763,
                "AOA": 605.25,
                "ARS": 74.246541,
                "AUD": 1.363588,
                "AWG": 1.8,
                "AZN": 1.7025,
                "BAM": 1.648688,
                "BBD": 2,
                "BDT": 84.798925,
                "BGN": 1.647463,
                "BHD": 0.376999,
                "BIF": 1930.044227,
                "BMD": 1,
                "BND": 1.360803,
                "BOB": 6.904074,
                "BRL": 5.3999,
                "BSD": 1,
                "BTC": 0.000087588018,
                "BTN": 73.166139,
                "BWP": 11.502307,
                "BYN": 2.653134,
                "BZD": 2.015452,
                "CAD": 1.307436,
                "CDF": 1961.953038,
                "CHF": 0.911218,
                "CLF": 0.028192,
                "CLP": 771.300945,
                "CNH": 6.828027,
                "CNY": 6.8275,
                "COP": 3681.147808,
                "CRC": 596.230978,
                "CUC": 1,
                "CUP": 25.75,
                "CVE": 92.65,
                "CZK": 22.2165,
                "DJF": 177.999547,
                "DKK": 6.276632,
                "DOP": 58.372146,
                "DZD": 127.871,
                "EGP": 15.8193,
                "ERN": 15.003124,
                "ETB": 36.685477,
                "EUR": 0.843441,
                "FJD": 2.0899,
                "FKP": 0.749535,
                "GBP": 0.749535,
                "GEL": 3.090448,
                "GGP": 0.749535,
                "GHS": 5.77917,
                "GIP": 0.749535,
                "GMD": 51.8,
                "GNF": 9665.181454,
                "GTQ": 7.729003,
                "GYD": 208.971626,
                "HKD": 7.75013,
                "HNL": 24.651749,
                "HRK": 6.3539,
                "HTG": 112.188041,
                "HUF": 302.467747,
                "IDR": 14805.5,
                "ILS": 3.3658,
                "IMP": 0.749535,
                "INR": 73.205101,
                "IQD": 1193.648687,
                "IRR": 42105,
                "ISK": 138.75,
                "JEP": 0.749535,
                "JMD": 148.080776,
                "JOD": 0.709,
                "JPY": 106.2745,
                "KES": 108.3,
                "KGS": 77.982926,
                "KHR": 4104.520823,
                "KMF": 412.949876,
                "KPW": 900,
                "KRW": 1187.165,
                "KWD": 0.305549,
                "KYD": 0.833189,
                "KZT": 419.03558,
                "LAK": 9100.807518,
                "LBP": 1511.780453,
                "LKR": 185.175809,
                "LRD": 199.300046,
                "LSL": 16.790063,
                "LYD": 1.362477,
                "MAD": 9.194846,
                "MDL": 16.585219,
                "MGA": 3834.459404,
                "MKD": 51.939021,
                "MMK": 1323.326614,
                "MNT": 2851.576,
                "MOP": 7.981471,
                "MRO": 357,
                "MRU": 38.122052,
                "MUR": 39.750693,
                "MVR": 15.40988,
                "MWK": 748.416602,
                "MXN": 21.841477,
                "MYR": 4.146,
                "MZN": 71.69,
                "NAD": 17.35,
                "NGN": 386.28,
                "NIO": 34.880319,
                "NOK": 8.777645,
                "NPR": 117.065459,
                "NZD": 1.48032,
                "OMR": 0.384966,
                "PAB": 1,
                "PEN": 3.527651,
                "PGK": 3.530601,
                "PHP": 48.62,
                "PKR": 165.478329,
                "PLN": 3.725775,
                "PYG": 6973.571083,
                "QAR": 3.639429,
                "RON": 4.0845,
                "RSD": 99.195,
                "RUB": 74.176267,
                "RWF": 967.246216,
                "SAR": 3.750522,
                "SBD": 8.265569,
                "SCR": 17.890932,
                "SDG": 55.3,
                "SEK": 8.685571,
                "SGD": 1.362065,
                "SHP": 0.749535,
                "SLL": 9886.580446,
                "SOS": 578.444259,
                "SRD": 7.458,
                "SSP": 130.26,
                "STD": 20973.366047,
                "STN": 20.7,
                "SVC": 8.748319,
                "SYP": 511.667713,
                "SZL": 16.794136,
                "THB": 31.2735,
                "TJS": 10.316068,
                "TMT": 3.51,
                "TND": 2.728401,
                "TOP": 2.263785,
                "TRY": 7.382531,
                "TTD": 6.776365,
                "TWD": 29.349498,
                "TZS": 2319.696,
                "UAH": 27.663691,
                "UGX": 3684.505321,
                "USD": 1,
                "UYU": 42.599377,
                "UZS": 10266.7974,
                "VEF": 248487.642241,
                "VES": 310860.15,
                "VND": 23185.763228,
                "VUV": 112.742216,
                "WST": 2.604843,
                "XAF": 553.261081,
                "XAG": 0.03624241,
                "XAU": 0.00051042,
                "XCD": 2.70255,
                "XDR": 0.703462,
                "XOF": 553.261081,
                "XPD": 0.00044151,
                "XPF": 100.649294,
                "XPT": 0.00107239,
                "YER": 250.349961,
                "ZAR": 16.782425,
                "ZMW": 19.647305,
                "ZWL": 322
            }
          }';
        $json = file_get_contents($url);
        //dd($json);
        $uahRate = json_decode($json)->rates->UAH;
        $eurRate = json_decode($json)->rates->EUR;
        $uah = UsdExchange::where('currency', 'UAH')->update(['sell' => $uahRate]);
        $eur = UsdExchange::where('currency', 'EUR')->update(['sell' => $eurRate]);
    }

    static public function uahToUsd($uah) {
        return  round( $uah / UsdExchange::findOrFail(1)->sell, 2 );
    }

    static public function usdToUah($usd) {

    }
}