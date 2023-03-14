<?php
namespace App\Controllers\API;

use App\Controllers\Controller;
use App\Http\Response;
use App\Models\API\User;
use Exception;
use App\Http\Validate;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
	public function login()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		try
		{
			$userId = (new User())->checkLogin($data);
			
			if(is_null($userId))
		{
			$response['status'] = 'error';
			$response['message'] = 'Invalid username or password';
			$response['time_response'] = time();
			return (new Response(200, $response, "application/json"))->sendResponse();
		}
		
		$time = time();
		
		$payload = [
			'sub' => $userId->id,
			'username' => $userId->username,
			'iat' => $time,
			'exp' => $time + 600,
		];
		
		$jwt = JWT::encode($payload, $_ENV['API_JWT_SECRET'], 'HS256');
		
		$response['status'] = 'success';
		$response['message'] = 'API running OK!';
		$response['jwt'] = $jwt;
		} catch(Exception $e)
		{
			$response['status'] = 'error';
			$response['message'] = $e->getMessage();
		}
		
		$response['time_response'] = time();
		return (new Response(200, $response, "application/json"))->sendResponse();
	}
}