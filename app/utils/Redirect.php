<?php
namespace App\Utils;

use App\Utils\Session;

class Redirect
{
	public static function to($path, array $with = [])
	{
		if(count($with))
		{
			foreach($with as $key => $value)
			{
				Session::flush($key, $value);
			}
		}
		
		header("Location: " . asset($path));
		exit;
	}
}