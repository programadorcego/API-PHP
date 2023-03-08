<?php
namespace App\Models;

use App\Core\Database;
use App\Http\Response;
use Exception;

#[\AllowDynamicProperties]
class Model
{
	protected $table;
	private $db;
	
	public function __construct()
	{
		$this->db = new Database();
	}
	
	public function all()
	{
		try
		{
			$results = $this->db->read($this->table)->fetchAll(\PDO::FETCH_CLASS, get_class($this));
			return $results;
		} catch(Exception $e)
			{
				throw new Exception($e->getMessage());
			}
	}
	
	public function create(array $data)
	{
		try
		{
			$id = $this->db->create($this->table, $data);
			return $this->find($id);
		} catch(Exception $e)
			{
				throw new Exception($e->getMessage());
			}
	}
	
	public function find($id)
	{
		try
		{
			return $this->db->read($this->table, where: "id={$id}")->fetchObject(get_class($this));
		} catch(Exception $e)
			{
				throw new Exception($e->getMessage());
			}
	}
	
	public function read($fields = '*', $where = null, $order = null, $limit = null)
	{
		try
		{
			return $this->db->read($this->table, $fields, $where, $order, $limit);
		} catch(Exception $e)
			{
				throw new Exception($e->getMessage());
			}
	}
	
	public function update($data, $id)
	{
		try
		{
			$this->db->update($this->table, $data, where: "id={$id}");
			return $this->find($id);
		} catch(Exception $e)
			{
				throw new Exception($e->getMessage());
			}
	}
	
	public function delete($id)
	{
		try
		{
			return $this->db->delete($this->table, where: "id={$id}");
		} catch(Exception $e)
			{
				throw new Exception($e->getMessage());
			}
	}
}