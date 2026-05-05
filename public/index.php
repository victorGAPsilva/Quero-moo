<?php

declare(strict_types=1);

session_start();

define('APP_ROOT', dirname(__DIR__));

$config = require APP_ROOT . '/config/config.php';

date_default_timezone_set('America/Sao_Paulo');

require APP_ROOT . '/core/helpers.php';
require APP_ROOT . '/core/Database.php';
require APP_ROOT . '/core/Model.php';
require APP_ROOT . '/core/Controller.php';
require APP_ROOT . '/core/Router.php';
require APP_ROOT . '/core/Auth.php';

require APP_ROOT . '/app/models/Product.php';
require APP_ROOT . '/app/models/Admin.php';

require APP_ROOT . '/app/controllers/HomeController.php';
require APP_ROOT . '/app/controllers/ProductController.php';
require APP_ROOT . '/app/controllers/AdminController.php';
require APP_ROOT . '/app/controllers/AuthController.php';

$router = new Router($config);

$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/catalogo', 'ProductController@index');
$router->add('GET', '/produto/{id}', 'ProductController@show');
$router->add('GET', '/sobre', 'HomeController@about');
$router->add('GET', '/contato', 'HomeController@contact');

$router->add('GET', '/admin/login', 'AuthController@showLogin');
$router->add('POST', '/admin/login', 'AuthController@login');
$router->add('POST', '/admin/logout', 'AuthController@logout');

$router->add('GET', '/admin', 'AdminController@dashboard');
$router->add('GET', '/admin/produtos', 'AdminController@productsIndex');
$router->add('GET', '/admin/produtos/novo', 'AdminController@productsCreate');
$router->add('POST', '/admin/produtos', 'AdminController@productsStore');
$router->add('GET', '/admin/produtos/{id}/editar', 'AdminController@productsEdit');
$router->add('POST', '/admin/produtos/{id}', 'AdminController@productsUpdate');
$router->add('POST', '/admin/produtos/{id}/deletar', 'AdminController@productsDelete');

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
