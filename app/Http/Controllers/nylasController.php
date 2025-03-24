<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class nylasController extends Controller

{

    public function getContacts()
    {
    $apiKey = 'nyk_v0_6Yd4ybwApyPtcsvqBMUYcYfMt2QxDflho9VsjrQlQ0snNSX1WUYfjhLb90L1kgjN';
    $url = 'https://api.eu.nylas.com/v3/grants/baa046d8-e7a0-441d-894e-89a06ee09344/messages?
 limit=5&unread=true';
    $params = [
        'limit' => 5,
    ];
    $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . $apiKey,
        'Content-Type' => 'application/json',
    ])->get($url,$params);


    }

    public function callBack(Request $request)
    {
        dd($request);
        return view('callback');
    }


  
 

}
