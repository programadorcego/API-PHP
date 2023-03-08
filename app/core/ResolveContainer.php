<?php
namespace App\Core;

use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use Exception;

class ResolveContainer
{
	private static $instance;
	
	public static function instance()
	{
		if(is_null(static::$instance))
		{
			static::$instance = new static;
		}
		
		return static::$instance;
	}
	
	public function call($class, $method, $params = [])
	{
		$methodReflection = new ReflectionMethod($class, $method);
		$methodParams = $methodReflection->getParameters();
		$dependencies = [];
		
		foreach($methodParams as $methodParam)
		{
			$type = $methodParam->getType();
			
			if($type && $type instanceof ReflectionNamedType)
			{
				$name = (new ReflectionClass($type->getName()))->newInstance();
				array_push($dependencies, $name);
			}
			else
			{
				$name = $methodParam->getName();
				
				if(array_key_exists($name, $params))
				{
					array_push($dependencies, $params[$name]);
				}
				else{
					throw new Exception("Erro! Parâmetro {$name} inválido!");
				}
			}
		}
		
		return $methodReflection->invoke(new $class(), ...$dependencies);
	}
}