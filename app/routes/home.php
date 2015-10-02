<?php

$app->get('/', function() use($app) {
    
    echo 'index';
    
})->name('home');