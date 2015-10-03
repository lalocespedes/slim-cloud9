<?php

$app->get('/', function() use($app) {
    
    $users = $app->user->all();
    
    dump($users);
    
    $db = $app->config->get('db.driver');
    
    $app->render('home.php', [
            'name'  => 'Josh',
            'db'    => $db
        ]
    );
    
})->name('home');
