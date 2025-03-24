<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MpesaController extends Controller
{
    private function generateAccessToken()
    {
        $client = new Client();
        $response = $client->request('GET','https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',['auth'=>[env('MPESA_CONSUMER_KEY'),env('MPESA_CONSUMER_SECRET')]]);
        $body = json_decode($response->getBody()->getContents());
        return $body->access_token;        
    }


    public function initiateStkPush(Request $request)
    {
        $timestamp = date('YmdHis');
        $password = base64_encode(env('MPESA_SHORTCODE'). env('MPESA_PASSKEY'). $timestamp);
        $accessToken = $this->generateAccessToken();
        $client = new Client();
        $response = $client->request('POST', 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'BusinessShortCode' => env('MPESA_SHORTCODE'),
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $request->amount,
                'PartyA' => $request->phone,
                'PartyB' => env('MPESA_SHORTCODE'),
                'PhoneNumber' => $request->phone,
                'CallBackURL' => env('MPESA_CALLBACK_URL'),
                'AccountReference' => 'Test',
                'TransactionDesc' => 'Payment for testing'
            ]
        ]);
    
        return response()->json(json_decode($response->getBody()->getContents()));
    }



    public function mpesaCallback(Request $request)
    {
        $callbackData = $request->all();

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Success']);
    }
}
