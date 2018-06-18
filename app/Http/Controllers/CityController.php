<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
    // This method returns the list of cities that match with a string, is a service of the api
    public function getCitiesapi($string) {
        if (!$string or $string == "") {
            return response()->json([
                'message'=>'No hay cadena para buscar ciudades',
                'data'=>[]
            ], 400);
        }
        $cities =  City::where('name', 'like', '%' . trim($string) . '%')->limit(5)->get();
        $data = [];
        foreach ($cities as $city) {
            $data_city = ["id" => $city->id, "name" => trim($city->name) . " - " . trim($city->getState->name)];
            array_push($data, $data_city);
        }

        return response()->json([
            'message'=>'Lista de ciudades encontradas',
            'data'=>$data
        ],200);
    }
}
