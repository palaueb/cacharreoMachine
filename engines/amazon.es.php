<?php

$variables = [
    '{{seach}}' => "esta_luego",
    'method'    => "GET",
    'path'      => "https://www.amazon.es/s?k={{search}}"
];
$steps = [
    0 => function($code){
        echo "function 0".PHP_EOL;
        return "0 ". $code;
    },
    1 => function($code){
        echo "function 1".PHP_EOL;
        return "1 ".$code;
    },
    2 => function($code){
        echo "function 2".PHP_EOL;
        return "2 ".$code;
    }
];
