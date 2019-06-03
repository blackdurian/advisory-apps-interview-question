<?php

//debug use
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}
$response['asd']='asdad';
$json_response = json_encode($response);
echo $json_response;
$token = bin2hex(openssl_random_pseudo_bytes(32));
echo $token;