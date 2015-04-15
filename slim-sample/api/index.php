<?php

require_once '../libs/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

require_once '../route/categories.php';

$app->run();


function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
    // setting response content type to json
    $app->contentType('application/json');
    echo json_encode($response);
}

function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();

    // Verifying Authorization Header
    if (isset($headers['Authorization'])) {
        // get the api key
        $api_key = $headers['Authorization'];

        // validating api key
        if ($api_key != 'secret') {
            // api key is not present in users table            
            $response["error"] = true;
            $response["message"] = "Access Denied. Invalid Api key";
            echoResponse(401, $response);
            $app->stop();
        } else {
            //do something when key is right
        }
    } else {
        // api key is missing in header        
        $response["error"] = true;
        $response["message"] = "Api key is misssing";
        echoResponse(400, $response);
        $app->stop();
    }
}
