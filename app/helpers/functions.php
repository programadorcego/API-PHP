<?php
if(!function_exists('url'))
{
	function url()
	{
		$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'on') ? 'https://' : 'http://';
		$host = $_SERVER['HTTP_HOST'];
		$dirname = pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME);
		
		return $protocol . $host . ($dirname === '\\' ? '' : $dirname);
	}
}

if(!function_exists('asset'))
{
	function asset($path)
	{
		return url() . "/{$path}";
	}
}

if(!function_exists('dd'))
{
	function dd($data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		die;
	}
}