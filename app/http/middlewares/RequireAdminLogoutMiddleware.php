<?php
namespace App\Http\Middlewares;

use App\Http\Request;
use Exception;
use Closure;
use App\Utils\Session;
use App\Utils\Redirect;

class RequireAdminLogoutMiddleware
{
	public function handle(Request $request, Closure $next)
	{
		if(!is_null(Session::get('user_logged')) && Session::get('user_logged'))
		{
			return Redirect::to('admin');
		}
		
		return $next($request);
	}
}