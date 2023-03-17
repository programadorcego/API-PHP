<?php
namespace App\Http\Middlewares\API;

use App\Http\Request;
use Exception;
use Closure;
use App\Utils\Cache\File as CacheFile;

class CacheMiddleware
{
	public function handle(Request $request, Closure $next)
	{
		if($request->getHttpMethod() != 'GET') return $next($response);
		
		$hash = $this->getHash($request);
		
		return CacheFile::getCache($hash, intval($_ENV['API_CACHE_EXPIRATION_TIME']), function() use($request, $next){
			return $next($request);
		});
	}
	
	private function getHash($request)
	{
		$uri = trim($request->getUri(), '/');
		$queryParams = $request->getQueryParams();
		$uri .= !empty($queryParams) ? '/?' . http_build_query($queryParams) : '';
		$hash = preg_replace('/[^0-9a-zA-Z]/', '-', $uri);
		$hash = str_replace('--', '-', $hash);
		return $hash;
	}
}