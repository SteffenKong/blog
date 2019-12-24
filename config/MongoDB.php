<?php
return [
    'host' => env('MONGODB_HOST','127.0.0.1'),
    'userName' => env('MONDODB_USERNAME',''),
    'password' => env('MONGODB_PASSWORD',''),
    'port' => env('MONGODB_PORT',27017),
    'db' => env('MONGODB_DBNAME',''),
];
