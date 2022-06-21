<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Resources\CityResource;

class CityDataController extends Controller
{
    public function __invoke(Request $request, $city_id){

        try{

            $city = cache()->rememberForever('city-' . $city_id , function () use ($city_id) {
                return City::with(City::$SHOW_WITH)->find($city_id);
            });

            if(!$city){
                throw new \Exception('City not found');
            }

            return response()->json([
                'city' => new CityResource($city)
            ]);
            
        } catch (\Exception $e){
            return response()->json([], 500);
        }
    }
}
