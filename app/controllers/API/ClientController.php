<?php
namespace App\Controllers\API;

use App\Controllers\Controller;
use App\Utils\Session;
use App\Http\Request;
use App\Http\Response;
use App\Models\API\Client;
use Exception;
use App\Http\Validate;

class ClientController extends Controller
{
	public function get_all_clients()
	{
		try
		{
			$response['status'] = 'success';
			$response['message'] = 'API running OK!';
			$clients = (new Client())->all();
			$response['total'] = count($clients);
			$response['clients'] = $clients;
		} catch(Exception $e)
		{
			$response['status'] = 'error';
			$response['message'] = 'Error! ' . $e->getMessage();
		}
		
		$response['time_response'] = time();
		
		return (new Response(200, $response, 'application/json'))->sendResponse();
	}
	
	public function get_client($id)
	{
		try
		{
			$response['status'] = 'success';
			$response['message'] = 'API running OK!';
			$client = (new Client())->find($id);
			$response['client'] = $client ? $client : [];
		} catch(Exception $e)
		{
			$response['status'] = 'error';
			$response['message'] = 'Error! ' . $e->getMessage();
		}
		
		$response['time_response'] = time();
		
		return (new Response(200, $response, 'application/json'))->sendResponse();
	}
	
	public function get_clients_by_name(Request $request)
	{
		$queryParams = $request->getQueryParams();
		
		$name = $queryParams['name'] ?? "";
		$name = str_replace(' ', '%', $name);
		
		try
		{
			$response['status'] = 'success';
			$response['message'] = 'API running OK!';
			$clients = (new Client())->read(where: "nome LIKE '%{$name}%'")->fetchAll();
			$response['total'] = count($clients);
			$response['clients'] = $response['total'] > 0 ? $clients : [];
		} catch(Exception $e)
		{
			$response['status'] = 'error';
			$response['message'] = 'Error! ' . $e->getMessage();
		}
		
		$response['time_response'] = time();
		
		return (new Response(200, $response, 'application/json'))->sendResponse();
	}
	
	public function get_clients_by_email(Request $request)
	{
		$queryParams = $request->getQueryParams();
		
		$email = $queryParams['email'] ?? "";
		$email = str_replace(' ', '%', $email);
		
		try
		{
			$response['status'] = 'success';
			$response['message'] = 'API running OK!';
			$clients = (new Client())->read(where: "email LIKE '%{$email}%'")->fetchAll();
			$response['total'] = count($clients);
			$response['clients'] = $response['total'] > 0 ? $clients : [];
		} catch(Exception $e)
		{
			$response['status'] = 'error';
			$response['message'] = 'Error! ' . $e->getMessage();
		}
		
		$response['time_response'] = time();
		
		return (new Response(200, $response, 'application/json'))->sendResponse();
	}
	
	public function get_clients_by_male()
	{
		try
		{
			$response['status'] = 'success';
			$response['message'] = 'API running OK!';
			$clients = (new Client())->read(where: "sexo = 'm'")->fetchAll();
			$response['total'] = count($clients);
			$response['clients'] = $response['total'] > 0 ? $clients : [];
		} catch(Exception $e)
		{
			$response['status'] = 'error';
			$response['message'] = 'Error! ' . $e->getMessage();
		}
		
		$response['time_response'] = time();
		
		return (new Response(200, $response, 'application/json'))->sendResponse();
	}
	
	public function get_clients_by_female()
	{
		try
		{
			$response['status'] = 'success';
			$response['message'] = 'API running OK!';
			$clients = (new Client())->read(where: "sexo = 'f'")->fetchAll();
			$response['total'] = count($clients);
			$response['clients'] = $response['total'] > 0 ? $clients : [];
		} catch(Exception $e)
		{
			$response['status'] = 'error';
			$response['message'] = 'Error! ' . $e->getMessage();
		}
		
		$response['time_response'] = time();
		
		return (new Response(200, $response, 'application/json'))->sendResponse();
	}
	
	public function add_client()
	{
		$data = json_decode(file_get_contents("php://input"), true);
		
		$rules = [
			'nome' => 'required',
			'email' => 'required|email|unique:'.Client::class,
			'sexo' => 'required',
			'telefone' => 'required|regex:[0-9]{10}',
			'morada' => 'required',
			'cidade' => 'required',
			'cliente_ativo' => 'required|regex:[01]{1}',
			'data_nascimento' => 'required|regex:[0-9]{4}\-[0-9]{2}\-[0-9]{2}',
		];
		
		$validate = Validate::make($data, $rules);
		if(!$validate->validate())
		{
			$response['status'] = 'error';
			$response['errors'] = $validate->getErrors();
			$response['time_response'] = time();
			return (new Response(200, $response, "application/json"))->sendResponse();
		}
		
		try
		{
			$client = (new Client())->create($data);
			
			$response['status'] = 'success';
			$response['message'] = 'API running OK!';
			$response['client'] = $client;
		} catch(Exception $e)
			{
				$response['status'] = 'error';
				$response['message'] = $e->getMessage();
			}
			
			$response['time_response'] = time();
			return (new Response(200, $response, "application/json"))->sendResponse();
	}
	
	public function edit_client($id)
	{
		$data = json_decode(file_get_contents("php://input"), true);
		
		$rules = [
			'nome' => 'required',
			'email' => 'required|email|unique:'.Client::class.',,'.$id,
			'sexo' => 'required',
			'telefone' => 'required|regex:[0-9]{10}',
			'morada' => 'required',
			'cidade' => 'required',
			'cliente_ativo' => 'required|regex:[01]{1}',
			'data_nascimento' => 'required|regex:[0-9]{4}\-[0-9]{2}\-[0-9]{2}',
		];
		
		$validate = Validate::make($data, $rules);
		if(!$validate->validate())
		{
			$response['status'] = 'error';
			$response['errors'] = $validate->getErrors();
			$response['time_response'] = time();
			return (new Response(200, $response, "application/json"))->sendResponse();
		}
		
		try
		{
			$client = (new Client())->update($data, $id);
			
			$response['status'] = 'success';
			$response['message'] = 'API running OK!';
			$response['client'] = $client;
		} catch(Exception $e)
			{
				$response['status'] = 'error';
				$response['message'] = $e->getMessage();
			}
			
			$response['time_response'] = time();
			return (new Response(200, $response, "application/json"))->sendResponse();
	}
	
	public function delete_client($id)
	{
		try
		{
			$delete = (new Client())->delete($id);
			
			$response['status'] = 'success';
			$response['message'] = 'API runnin OK!';
		} catch(Exception $e)
			{
				$response['status'] = 'error';
				$response['message'] = $e->getMessage();
			}
			
			$response['time_response'] = time();
			return (new Response(200, $response, "application/json"))->sendResponse();
	}
}