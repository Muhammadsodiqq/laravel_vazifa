<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // for add products
    public function addProduct(Request $request) {
        try {

            $request->validate([
                "title" => "required | max:255 | min:2",
                "amount" => "required | numeric"
            ]);

            $data = new Product();

            $data->title = $request->title;
            $data->amount = $request->amount;

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

    // for get products
    public function getProducts() {
        try {
            $data = Product::all();

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
