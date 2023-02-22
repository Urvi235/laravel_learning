<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendSuccessResponse($messages, $data) {
        return response()->json(['success' => true, 'status_code' => 200, 'message' => $messages, 'data' => $data]);
    }

    // public function sendFailResponse($error, $errorMessages = [], $code = 404)
    // {
    // 	$response = [
    //         'success' => false,
    //         'message' => $error,
    //     ];

    //     if(!empty($errorMessages)){
    //         $response['data'] = $errorMessages;
 
    //     }
    //     return response()->json($response, $code);        
    // }
    public function sendFailResponse($exception, $errors = null)
    {
        if (is_a($exception, 'Exception')) {
            $errorCode = $exception->getCode();

            if ($errorCode == 0) {
                $message = $exception->getMessage();
            } else {
                $message = "Try again  after some time.";

                $errors = json_decode(file_get_contents(resource_path('errors.json')));
              
                $errorKey =  array_search($errorCode, array_column($errors, 'code'));


                if ($errorKey) {
                    $error = $errors[$errorKey];
                    $message = $error->message;
                }
            }
        } else {
            $errorCode = 00000;
            $message = $exception;
        }

        if($errors == null) {
            return response()->json(['success' => false, 'code' => $errorCode, 'message' => $message]);
        }
        return response()->json(['success' => false, 'code' => $errorCode, 'message' => $message, 'error' => $errors]);
    }
}
