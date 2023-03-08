<?php
namespace App\Http;

use App\Http\Request;
use App\Http\Response;
use App\Http\Middlewares\MiddlewareQueue;
use Exception;

class Route
{
	private $routes = [];
	private $request;
	
	public function __construct()
	{
		$this->request = new Request();
	}
	
	private function addRoute($httpMethod, $route, $controller, $middlewares)
	{
		list($controller, $action) = explode('@', $controller);
		$routes = [];
		
		$routes['controller'] = $controller;
		$routes['action'] = $action;
		$routes['params'] = [];
		$routes['middlewares'] = $middlewares;
		
		$paramPattern = '/{(.*?)}/';
		
		if(preg_match_all($paramPattern, $route, $matches))
		{
			$route = preg_replace($paramPattern, '(.*?)', $route);
			$routes['params'] = $matches[1];
		}
		
		$routePattern = '/^' . str_replace('/', '\/', $route) . '$/';
		$this->routes[$routePattern][$httpMethod] = $routes;
	}
	
	public function get($route, $controller, array $middlewares = [])
	{
		$this->addRoute('GET', $route, $controller, $middlewares);
	}
	
	public function post($route, $controller, array $middlewares = [])
	{
		$this->addRoute('POST', $route, $controller, $middlewares);
	}
	
	public function put($route, $controller, array $middlewares = [])
	{
		$this->addRoute('PUT', $route, $controller, $middlewares);
	}
	
	public function delete($route, $controller, array $middlewares = [])
	{
		$this->addRoute('DELETE', $route, $controller, $middlewares);
	}
	
	private function getUrl()
	{
		$uri = rtrim($this->request->getUri(), '/');
		$dirname = pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME);
		$url = substr($uri, strlen($dirname));
		$url = ltrim($url, '/');
		$url = $url === "" ? '/' : $url;
		return $url;
	}
	
	private function getRoute()
	{
		$url = $this->getUrl();
		$httpMethod = $this->request->getHttpMethod();
		
		foreach($this->routes as $routePattern => $route)
		{
			if(preg_match($routePattern, $url, $match))
			{
				if(isset($route[$httpMethod]))
				{
					unset($match[0]);
					$route[$httpMethod]['params'] = array_combine($route[$httpMethod]['params'], $match);
					return $route[$httpMethod];
				}
			
			throw new Exception("Método Inválido", 405);
			}
		}
		
		throw new Exception("URL não encontrada", 404);
	}
	
	public function run()
	{
		try
		{
			$route = $this->getRoute();
			return (new MiddlewareQueue($route))->next($this->request);
		} catch (Exception $e)
			{
				$response = new Response($e->getCode(), $e->getMessage());
				return $response->sendResponse();
			}
	}
}