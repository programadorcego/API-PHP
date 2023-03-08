<?php
namespace App\Models;

use App\Models\Model;

class User extends Model
{
	protected $table = 'usuarios';
	
	public function checkLogin(array $data)
	{
		$data['password'] = md5($data['password']);
		$where = "username = '$data[username]' AND password = '$data[password]' OR email = '$data[username]' AND password = '$data[password]'";
		
		$id = $this->read('id', $where)->fetchObject();
		
		if($id === false)
		{
			return null;
		}
		
		return $id->id;
	}
}