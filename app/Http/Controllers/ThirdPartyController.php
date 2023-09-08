<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class ThirdPartyController extends Controller
{
    public function index() {
        $response = Http::get('https://www.themealdb.com/api/json/v1/1/categories.php');
        return response()->json($response->json());
        // $data = collect($response->json());
        // return response()->json($data);
    }
}