<?php

namespace App\Http\Controllers\API\CustomEdition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApiFlag;


class EngineScalpingController extends Controller
{
    public function index(Request $request)
    {
       
        

        $createData = 
        $result = ApiFlag::updateOrCreate([
            'email' => $request->input('email')
        ],[
            'key' => $request->input('key'),
            'coin_id' => $request->input('coin'),
            'coin_name' => $request->input('coin_name') ?? "x",
            'secretKey' => $request->input('secretKey'),
            'last_hit' => "01",
        ]);

        return response()->json($result);
    }
}
