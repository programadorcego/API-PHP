<?php
namespace App\Http\Middlewares\API;

use App\Http\Request;
use App\Http\Response;
use Exception;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTMiddleware
{
	public function handle(Request $request, Closure $next)
	{
		$headers = getallheaders();
		
		if(!isset($headers['Authorization']) || strpos($headers['Authorization'], 'Bearer') === false)
		{
			$response['status'] = 'error';
			$response['message'] = 'Authorization header is missing!';
			$response['time_response'] = time();
			return (new Response(200, $response, "application/json"))->sendResponse();
		}
		
		try
		{
			$jwt = substr($headers['Authorization'], 7);
			$decoded = JWT::decode($jwt, new Key($_ENV['API_JWT_SECRET'], 'HS256'));
			
			return $next($request);
		} catch(Exception $e)
			{
				$response['status'] = 'error';
			$response['message'] = $e->getMessage();
			$response['time_response'] = time();
			return (new Response(200, $response, "application/json"))->sendResponse();
			}
	}
}