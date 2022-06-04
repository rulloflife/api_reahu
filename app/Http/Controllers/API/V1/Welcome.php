<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Welcome extends Controller
{
    public function welcome()
    {
        return response()->json([
            'success' => 1,
            'message' => 'welcome',
        ]);
    }
}
