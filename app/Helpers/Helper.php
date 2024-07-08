<?php

namespace App\Helpers;

class Helper
{
    public function removeWhiteSpaces($data) {
        return preg_replace('/[\n\r]+/', ',', trim($data));
    }

    public function errorResponse($message)
    {
        return $this->response([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);

    }

    public function apiResponse($data = [],$code,$message,$error=false )
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code,
            'error' => $error,
        ]);
    }
}
