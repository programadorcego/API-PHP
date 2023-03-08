<?php
namespace App\Core;

use PDO;
use PDOException;
use Exception;

class Database
{
	private $pdo;
	
	public function __construct()
	{
		$dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'];
		
		try
		{
			$this->pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [PDO::ATTR_PERSISTENT => true]);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		} catch(PDOException $e)
			{
				throw new Exception("Erro na conexxão! " . $e->getMessage());
			}
	}
	
	public function query($query, $params = [])
	{
		try
		{
			$stmt = $this->pdo->prepare($query);
			$stmt->execute($params);
			return $stmt;
		} catch(PDOException $e)
			{
				throw new Exception($e->getMessage());
			}
	}
	
	public function read(string $table, $fields = '*', $where = null, $order = null, $limit = null)
	{
		$where = is_null($where) ? '' : " AND {$where}";
		$order = is_null($order) ? '' : " ORDER BY {$order}";
		$limit = is_null($limit) ? '' : " LIMIT {$limit}";
		
		$sql = "SELECT {$fields} FROM $table WHERE 1{$where}{$order}{$limit}";
		
		try
		{
			
			return $this->query($sql);
		} catch(PDOException $e){
			throw new Exception($e->getMessage());
		}
	}
	
	public function create(string $table, array $data)
	{
		$columns = implode(", ", array_keys($data));
		$values = implode(", ", array_fill(0, count($data), "?"));
		
		try 
		{
			$sql = "INSERT INTO $table ($columns) VALUES ($values)";
			$this->query($sql, array_values($data));
			return $this->pdo->lastInsertId();
		} catch(PDOException $e)
		{
			throw new Exception("Erro! " . $e->getMessage());
		}
	}
	
	public function update($table, $data, $where = null)
	{
		$where = is_null($where) ? '' : " AND {$where}";
		$fields = array_keys($data);
		$fields = implode("=?, ", $fields) . '=?';
		$sql = "UPDATE $table SET $fields WHERE 1 $where";
		
		try
		{
			$this->query($sql, array_values($data));
			return true;
		} catch(PDOException $e){
				throw new Exception("Erro! " . $e->getMessage());
		}
	}
	
	public function delete($table, $where = null)
	{
		$where = is_null($where) ? '' : " AND {$where}";
		$sql = "DELETE FROM $table WHERE 1 $where";
		
		try
		{
			$this->query($sql);
			return true;
		} catch(PDOException $e){
			throw new Exception("Erro! " . $e->getMessage());
		}
	}
}