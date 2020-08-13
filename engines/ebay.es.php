<?php


$variables = [
    '{{seach}}' => "esta_luego",
    'method'    => "GET",
    'path'      => "https://www.ebay.es/sch/i.html?_nkw={{search}}"
];
$steps = [
    0 => function($code){
        echo "function 0".PHP_EOL;
        return $code;
    },
    1 => function($code){
        echo "function 1".PHP_EOL;
        return $code;
    },
    2 => function($code){
        echo "function 2".PHP_EOL;
        return $code;
    }
];
