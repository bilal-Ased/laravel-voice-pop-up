<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CallController extends Controller
{
 
    public function show(Request $request)
    {
        // Retrieve the call_id from the query string
        $callId = $request->query('call_id');

        // Return a simple view with the call_id
        return view('call', ['callId' => $callId]);
    }

    
}
