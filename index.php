<?php
require 'vendor/autoload.php';

Flight::route('/', function(){
    $authEndpoint = 'https://webobservatory.soton.ac.uk/oauth/authorise';
    $params = http_build_query(array(
        'response_type'=>'token',
        'client_id'=>'559ae81d0dc1819807f1244f',
        'redirect_uri'=>'http://webobservatory.me/home'
    ));
    Flight::redirect($authEndpoint.'?'.$params);

});

Flight::route('/home', function(){
    var_dump(Flight::request()->getBody());
    echo '<br><br>home'.Flight::request()->data->token_type;
});

Flight::route('/user', function(){
    //open connection
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, 'http://webobservatory.soton.ac.uk/api/userInfo');
    curl_setopt($ch,CURLOPT_HTTPHEADER,array (
        "Authorization:Bearer "
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //execute get
    $result = curl_exec($ch);

    //close connection
    curl_close($ch);

    echo $result;
});

Flight::start();