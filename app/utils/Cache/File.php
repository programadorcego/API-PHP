<?php
namespace App\Utils\Cache;
use Closure;

class File
{
	public static function getCache(string $hash, int $expiration, Closure $function)
	{
		if($content = self::getContentCache($hash, $expiration)) return gettype($content) == 'string' ? print $content : $content;
		
		$content = $function();
		
		self::storeCache($hash, $content);
		
		return $content;
	}
	
	private static function storeCache($hash, $content)
	{
		$cacheFile = self::getFilePath($hash);
		
		$serialize = serialize($content);
		return file_put_contents($cacheFile, $serialize);
	}
	
	private static function getFilePath($hash)
	{
		$cacheDir = __DIR__ . '/../../../storage/cache';
		
		if(!file_exists($cacheDir)) mkdir($cacheDir, 0755, true);
		
		return "{$cacheDir}/{$hash}";
	}
	
	private static function getContentCache($hash, $expiration)
	{
		$cacheFile = self::getFilePath($hash);
		
		if(!file_exists($cacheFile)) return false;
		
		$createdTime = filemtime($cacheFile);
		$diffTime = time() - $createdTime;
		
		if($diffTime > $expiration) return false;
		
		$content = unserialize(file_get_contents($cacheFile));
		return $content;
	}
}