<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function success($sucess, $mesg, $data = [], $code = 200)
    {
        return response()->json([
            'success' => $sucess,
            'message' => $mesg,
            'data' => $data,
        ], $code);
    }

    protected function error($mesg)
    {
        return response()->json([
            'success' => false,
            'message' => $mesg,
        ], 404);
    }
}
