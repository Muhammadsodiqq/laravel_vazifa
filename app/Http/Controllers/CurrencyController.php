<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CurrencyController extends Controller
{

    // create currensy . 3 - mashq
    public function getCurrency(Request $request) {
        try {
            $client = new Client();

            $response = $client->get("https://openexchangerates.org/api/currencies.json");

            $response = json_decode($response->getBody(), true);


            $keys = array_keys($response);
            $values = array_values($response);

            for( $i = 0; $i < count($keys); $i++ ) {

                $currensy = new Currency();
                $currensy->short_name = $keys[$i];
                $currensy->country = $values[$i];
                $currensy->save();

            };

            $data = Currency::all();

            return response()->json([
                'ok' => true,
                'data' => $data,
            ]);

        }catch(\Exception $error) {

            return response()->json([
                'ok' => false,
                'msg' => $error->getMessage(),
            ]);

        }
    }
}
