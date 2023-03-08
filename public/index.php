<?php
if(session_status() != PHP_SESSION_ACTIVE)
{
	session_start();
}

date_default_timezone_set("America/Sao_Paulo");

require "../vendor/autoload.php";
require '../bootstrap/app.php';

use App\Http\Route;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$route = new Route();
require __DIR__ . '/../routes/web.php';
require __DIR__ . '/../routes/api.php';
$route->run();