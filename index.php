<?php
require 'vendor/autoload.php';

Flight::route('/', function(){
    echo "nothing here";
});

Flight::start();