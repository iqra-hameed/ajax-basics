<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prod;
use App\Http\Resources\ProductResource;

class ProdController extends Controller
{
    public function index(){
    return response()->json(ProductResource::collection(Prod::all()),200);
    }
    function search($name)
    {
        $result = Prod::where('name_en', 'LIKE', '%'. $name. '%')->get();
        if(count($result)){
         return Response()->json($result);
        }
        else
        {
        return response()->json(['Result' => 'No Data not found'], 404);
      }
    }
}
