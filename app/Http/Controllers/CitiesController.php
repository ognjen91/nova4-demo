<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Resources\CityResource;

class CitiesController extends Controller
{
    public function __invoke(Request $request){

        try{

            $cities =  cache()->rememberForever('cities', function () {
                return City::with(City::$INDEX_WITH)->get();
            });

            // dd($cities);

            if(!$cities){
                throw new \Exception('City not found');
            }

            return response()->json([
                'cities' => CityResource::collection($cities)
            ]);
            
        } catch (\Exception $e){
            dd($e->getMessage());
            return response()->json([], 500);
        }
    }
}
