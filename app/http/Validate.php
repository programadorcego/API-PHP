<?php
namespace App\Http;

use Exception;

class Validate
{
	private static $data = [];
	private static $errors = [];
	private static $customErrors = [];
	
	public static function make(array $data, array $rules, array $errors = [])
	{
		self::$data = $data;
		self::$customErrors = $errors;
		
		foreach($rules as $field => $rule)
		{
			$functions = explode('|', $rule);
			
			for($i = 0; $i < count($functions); $i++)
			{
			$params = [$field];
			$function = $functions[$i];
			
			if(strpos($function, ":") !== false)
			{
				list($function, $param) = explode(":", $function);
				array_push($params, ...explode(',', $param));
			}
			
			call_user_func_array([self::class, $function], $params);
			}
		}
		
		return new self();
	}
	
	private static function required($field)
	{
		if(!isset(self::$data[$field]) || trim(self::$data[$field]) === "")
		{
			if(isset(self::$customErrors[$field . '.' . __FUNCTION__]))
			{
				self::$errors[] = self::$customErrors[$field . '.' . __FUNCTION__];
				return new self();
			}
			
			self::$errors[] = sprintf("O campo %s é obrigatório!", $field);
		}
		
		return new self();
	}
	
	private static function email($field)
	{
		if(!filter_var(self::$data[$field], FILTER_VALIDATE_EMAIL))
		{
			if(isset(self::$customErrors[$field . '.' . __FUNCTION__]))
			{
				self::$errors[] = self::$customErrors[$field . '.' . __FUNCTION__];
				return new self();
			}
			
			self::$errors[] = sprintf("O campo %s deve conter um e-mail válido!", $field);
			return new self();
		}
	}
	
	private static function min($field, $number)
	{
		if(!empty(trim(self::$data[$field])) && strlen(self::$data[$field]) < intval($number))
		{
			if(isset(self::$customErrors[$field . '.' . __FUNCTION__]))
			{
				self::$errors[] = self::$customErrors[$field . '.' . __FUNCTION__];
				return new self();
			}
			
			self::$errors[] = sprintf("O campo %s deve ter no mínimo %d caracteres!", $field, intval($number));
			return new self();
		}
	}
	
	private static function max($field, $number)
	{
		if(!empty(trim(self::$data[$field])) && strlen(self::$data[$field]) > intval($number))
		{
			if(isset(self::$customErrors[$field . '.' . __FUNCTION__]))
			{
				self::$errors[] = self::$customErrors[$field . '.' . __FUNCTION__];
				return new self();
			}
			
			self::$errors[] = sprintf("O campo %s deve ter no máximo %d caracteres!", $field, intval($number));
			return new self();
		}
	}
	
	private static function confirm($field)
	{
		if(self::$data[$field] !== self::$data["{$field}_confirm"])
		{
			if(isset(self::$customErrors[$field . '.' . __FUNCTION__]))
			{
				self::$errors[] = self::$customErrors[$field . '.' . __FUNCTION__];
				return new self();
			}
			
		self::$errors[] = sprintf("O campo %s e o campo %s devem ser iguais!", $field, "{$field}_confirm");
			return new self();
		}
	}
	
	private static function unique($field, $model, $column = null, $ignore = null, $primary = 'id')
	{
		$column = (!is_null($column) && !empty($column)) ? $column : $field;
		$value = trim(self::$data[$field]);
		$where = (!is_null($ignore) && !empty($ignore)) ? "AND {$primary} <> '{$ignore}'" : '';
		
		try
		{
			// SELECT COUNT(nome_da_coluna) AS total WHERE nome_da_coluna = valor
			// SELECT COUNT(nome_da_coluna) AS total WHERE nome_da_coluna = valor AND chave_primaria <> valor
			$total = (new $model)->read(fields: "COUNT({$column}) AS total", where: "{$column} = '{$value}' {$where}")->fetchObject()->total;
			
			if($total > 0)
			{
				if(isset(self::$customErrors[$field . '.' . __FUNCTION__]))
				{
					self::$errors[] = self::$customErrors[$field . '.' . __FUNCTION__];
					return new self();
				}
				
				self::$errors[] = sprintf("O campo %s deve ter um valor único!", $field);
			}
		
		return new self();
		} catch(Exception $e)
			{
				throw new Exception($e->getMessage());
			}
	}
	
	private static function regex($field, $pattern)
	{
		if(!empty(self::$data[$field]) && !preg_match('/^' . $pattern . '$/', self::$data[$field]))
		{
			if(isset(self::$customErrors[$field . '.' . __FUNCTION__]))
			{
				self::$errors[] = self::$customErrors[$field . '.' . __FUNCTION__];
				return new self();
			}
			
			self::$errors[] = sprintf("O campo %s deve corresponder ao padrão %s!", $field, $pattern);
			return new self();
		}
	}
	
	public function validate()
	{
		if(count(self::$errors))
		{
			return false;
		}
		
		return true;
	}
	
	public function getErrors()
	{
		return self::$errors;
	}
}