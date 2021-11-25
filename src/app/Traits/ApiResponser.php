<?php
namespace App\Traits;
use Illuminate\Http\Response;

trait ApiResponser{

    protected function jsonResponse($data=[], $code = Response::HTTP_OK){
        return response()->json($data, $code);
    }

    protected function successResponse($data=null, $message='OK!', $code = Response::HTTP_OK){
        return response()->json([
            'code'=>$code, 
            'message'=>$message, 
            'data'=>$data
        ], $code);
    }

    protected function errorResponse($message="", $errors=[], $code= 500){
        return response()->json([
            'code'=>$code, 
            'message'=>$message, 
            'errors'=>$errors
        ], $code);
    }

    protected function successWithMetaResponse($meta=null, $data=null, $message='OK!', $code = Response::HTTP_OK){
        return response()->json([
            'code'=>$code, 
            'message'=>$message, 
            'meta'=>$meta,
            'data'=>$data,
        ], $code);
    }

}