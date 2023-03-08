<?php
namespace App\Utils;

class Session
{
	private static function add($type, $key, $value)
	{
		$_SESSION[$key]['type'] = $type;
		$_SESSION[$key]['value'] = $value;
	}
	
	public static function set($key, $value)
	{
		self::add('session', $key, $value);
	}
	
	public static function get($key)
	{
		$session = "";
		
		if(isset($_SESSION[$key]))
		{
			$session = $_SESSION[$key]['value'];
		}
		
		if(isset($_SESSION[$key]) && $_SESSION[$key]['type'] == 'flush')
		{
			self::destroy($key);
		}
		
		return $session;
	}
	
	public static function flush($key, $value)
	{
		self::add('flush', $key, $value);
	}
	
	public static function destroy($key)
	{
		if(isset($_SESSION[$key]))
		{
			unset($_SESSION[$key]);
		}
	}
	
	public static function has($key)
	{
		return isset($_SESSION[$key]);
	}
}