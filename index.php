<?php

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

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

require './app/routes.php';

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

$app->run();