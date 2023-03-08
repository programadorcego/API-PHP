<?php
namespace App\Http\Middlewares;

use App\Http\Request;
use Exception;
use Closure;

class Maintenance
{
	public function handle(Request $request, Closure $next)
	{
		if($_ENV['SITE_MAINTENANCE'] == 'true')
		{
			throw new Exception('Site em manutenção. Tente novamente mais tarde!');
		}
		
		return $next($request);
	}
}