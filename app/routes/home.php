<?php

$app->get('/', function() use($app) {

    $db = $app->config->get('db.driver');
    
    $app->render('home.php', [
            'name'  => 'Josh',
            'db'    => $db
        ]
    );
    
})->name('home');
