<?php
require_once "vendor/autoload.php";
$api=new ApiHelper();
$api->validateMethod();
$api->validateResource();
$method=strtolower($_SERVER["REQUEST_METHOD"]);
switch ($method)
{
    case "get" :
        $api->apiGet();
        break;
    case "post":
        break;
    case "delete":
        break;
    case "update":
        break;
}
