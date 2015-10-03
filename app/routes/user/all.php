<?php

$app->get('/users', APIrequest, function() use($app) {
   
    $users = $app->user->all();
    
    $app->render(200, $users->toArray());
    
})->name('users');
