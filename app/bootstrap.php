<?php

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Noodlehaus\Config;

//models
use lalocespedes\Models\User\User;

// set timezone for timestamps etc
date_default_timezone_set('Mexico/General');
session_cache_limiter(false);
session_start();
ini_set('display_errors', On);

define('INC_ROOT', dirname(__DIR__));

require './vendor/autoload.php';

switch ($_SERVER['HTTP_HOST']) {
	case 'slim-lalocespedes.c9.io':
		$env = 'development';
	break;
	default:
		$env = 'production';
	break;
}

define('ENVIRONMENT', $env);

$app = new Slim([
	'mode'	=> ENVIRONMENT,
	'view'	=> new Twig(),
	'templates.path' =>  './app/views'
]);

$app->configureMode($app->config('mode'), function() use ($app) {
	$app->config = Config::load( "./app/config/{$app->mode}.php");
});

require  './app/routes.php';
require  './app/config/database.php';

$view = $app->view();

$view->parseOptions = [
	'charset'	        => 'utf-8',
	'auto_reload'       => true,
    'strict_variables'  => false,
    'autoescape'        => true,
	'debug'		        => true
];

$view->parserExtensions = [
	new TwigExtension
];

//containers

$app->container->set('user', function() {
	return new User;
});

function APIrequest() {
      $app = \Slim\Slim::getInstance();
      $app->view(new \JsonApiView());
      $app->add(new \JsonApiMiddleware());
}

$app->container->set('phinx', function() use($app) {
	
	$phinx = new Phinx\Console\PhinxApplication();
	return new Phinx\Wrapper\TextWrapper($phinx, [
		'configuration' => './app/phinx.yml',
		'parser'		=> 'yaml',
		'name' 			=> $app->config->get('db.name'),
		'user'			=> $app->config->get('db.username'),
		'pass'			=> $app->config->get('db.password')
	]);
});
