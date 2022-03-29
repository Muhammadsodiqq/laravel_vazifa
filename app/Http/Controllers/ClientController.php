<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // for signup client
    public function Signup(Request $request) {
        try {

            $request->validate([
                "phone" => "required | regex: /^9989[012345789][0-9]{7}$/ | unique:clients",
                "name" => "required | max:255 | min:2",
                "family" => "required | max:255 | min:2",
            ]);

            $data = new Client();

            $data->phone = $request->phone;
            $data->name = $request->name;
            $data->family = $request->family;

            $data->save();

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


    //for buy product by client
    public function BuyProduct(Request $request) {
        try {

            $request->validate([
                "client_id" => "required|numeric",
                "product_id" => "required|numeric",
            ]);

            $product = Product::where("id", $request->product_id)->first();

            if(!$product) throw new \Exception("there is no product like that") ;

            Product::where("id", $request->product_id)->update( ["client_id" => $request->client_id] );

            return response()->json([
                'ok' => true,
                'msg' => "succes",
            ]);

        }catch(\Exception $error) {

            return response()->json([
                'ok' => false,
                'msg' => $error->getMessage(),
            ]);

        }
    }


    // for getone client information
    public function getUser(Request $request) {
        try {

            $client = Client::where("id", $request->id)->first();
            $client->product;

            return response()->json([
                'ok' => true,
                'data' => $client,
            ]);

        }catch(\Exception $error) {

            return response()->json([
                'ok' => false,
                'msg' => $error->getMessage(),
            ]);

        }
    }


    // for get all clients information 2-mashq uchun
    public function getUsers(Request $request) {
        try {

            $client = Client::with("product")->get();
            // $client->product;

            return response()->json([
                'ok' => true,
                'data' => $client,
            ]);

        }catch(\Exception $error) {

            return response()->json([
                'ok' => false,
                'msg' => $error->getMessage(),
            ]);

        }
    }
}
