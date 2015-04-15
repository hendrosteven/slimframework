<?php
require_once '../core/service/CategoryService.php';

$app->get('/categories','authenticate', 'getAll');

function getAll() {       
    $svr = new CategoryService();
    $response['error'] = false;    
    $response['data'] = $svr->getCategories();
    echoResponse(200, $response);    
}



