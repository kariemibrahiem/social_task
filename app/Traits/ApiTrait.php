<?php

namespace App\Traits;

trait ApiTrait
{
    public function successResponse($data = [], $status = 200, $message = "تمت العملية بنجاح")
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data]);
    }

    public function errorResponse($message = "حدث خطأ ما.", $status = 500, $error = null)
    {
        return response()->json(['status' => $status, 'message' => $message, 'error' => $error]);
    }
}
