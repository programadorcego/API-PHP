<?php
namespace App\Models\API;

use App\Models\Model;

class User extends Model
{
	protected $table = 'users';
	
	public function checkLogin(array $data)
	{
		$where = "username = '$data[username]'";
		
		$id = $this->read('id, username, password', $where)->fetchObject();
		
		if($id === false)
		{
			return null;
		}
		
		if(!password_verify($data['password'], $id->password))
		{
			return null;
		}
		
		return $id;
	}
}