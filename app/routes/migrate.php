<?php

$app->get('/db/migrate', function() use ($app) {

	$command = call_user_func([$app->phinx, 'getMigrate']);
	header('Content-Type: text/plain', true, 200);
	echo $command;

})->name('db.migrate');

$app->get('/db/rollback', function() use ($app) {

	$command = call_user_func([$app->phinx, 'getRollback']);
	header('Content-Type: text/plain', true, 200);
	echo $command;

})->name('db.rollback');

$app->get('/db/status', function() use ($app) {

	$command = call_user_func([$app->phinx, 'getStatus']);
	header('Content-Type: text/plain', true, 200);
	echo $command;

})->name('db.status');
