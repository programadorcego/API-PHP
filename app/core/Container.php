<?php
namespace App\Core;

use App\Core\ResolveContainer;

class Container
{
	public static function instance($route)
	{
		/*$controller = new $route['controller']();
		return $controller->{$route['action']}(...$route['params']);*/
		
		$container = ResolveContainer::instance();
		return $container->call($route['controller'], $route['action'], $route['params']);
	}
}