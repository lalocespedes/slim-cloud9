<?php

$app->get('/', function() use($app) {
    
    echo 'index';
    
    echo $app->config->get('db.driver');
    
})->name('home');