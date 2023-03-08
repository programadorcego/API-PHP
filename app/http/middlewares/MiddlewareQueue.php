<?php
namespace App\Http\Middlewares;

use App\Http\Request;
use App\Core\Container;
use Exception;

class MiddlewareQueue
{
	private $route = [];
	private static $map = [];
	private static $defaultMiddlewares = [];
	
	public function __construct($route)
	{
		$this->route = $route;
		$this->route['middlewares'] = array_merge(self::$defaultMiddlewares, $this->route['middlewares']);
	}
	
	public function next(Request $request)
	{
		if(empty($this->route['middlewares'])) return Container::instance($this->route);
		
		$middleware = array_shift($this->route['middlewares']);
		
		if(!isset(self::$map[$middleware]))
		{
			throw new Exception('Erro ao processar a middleware da rota!');
		}
		$queue = $this;
		
		$next = function($request) use($queue) {
			return $queue->next($request);
		};
		
		return (new self::$map[$middleware])->handle($request, $next);
	}
	
	public static function setMap(array $map)
	{
		self::$map = $map;
	}
	
	public static function setDefaultMiddlewares(array $defaultMiddlewares)
	{
		self::$defaultMiddlewares
		= $defaultMiddlewares;;
	}
}