<?php
namespace App\Controllers;

use App\Controllers\PageController;
use App\Utils\Session;
use App\Utils\Redirect;
use App\Http\Request;
use App\Http\Response;
use App\Models\User;

class AuthController extends PageController
{
	public function index()
	{
		$title = "Login";
		$this->renderLayout('login/index', compact('title'));
	}
	
	public function login(Request $request)
	{
		$data = $request->getPostParams();
		$userId = (new User())->checkLogin($data);
		
		if(is_null($userId))
		{
			return Redirect::to('login', ['errors' => ['Usuário ou senha inválidos!']]);
		}
		
		Session::set('user_logged', true);
		Session::set('user_id', $userId);
		return Redirect::to('admin');
	}
	
	public function logout()
	{
		Session::destroy('user_logged');
		Session::destroy('user_id');
		return Redirect::to('login');
	}
}