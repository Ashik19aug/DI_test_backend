<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    protected function successResponse($data, $message='success'){
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }
    protected function failedResponseWithError($exception, $message = null, $data=null){
        return response()->json([
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message ?? 'error',
            'data'=>$data??(object)[],
            'errors' => property_exists($exception, 'errors') ? $exception->errors() : [],
        ]);
    }

}
