<?php
namespace App\Http;

class Request
{
	// Método da requisição
	private $httpMethod;
	
	// URL acessada
	private $uri;
	
	// Cabeçalhos da requisição
	private $headers = [];
	
	// Query String
	private $queryParams = [];
	
	// Dados do método post
	private $postParams = [];
	
	// Método construtor
	public function __construct()
	{
		$this->httpMethod = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
		$this->uri = parse_url(filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL), PHP_URL_PATH);
		$this->queryParams = $_GET;
		$this->postParams = $_POST;
		$this->headers = getallheaders();
	}
	
	// Retorna a url em $this->uri
	public function getUri()
	{
		return $this->uri;
	}
	
	// Retorna o método da Requisição em $this->httpMethod
	public function getHttpMethod()
	{
		return $this->httpMethod;
	}
	
	// Retorna os valores da query string em $this->queryParams
	public function getQueryParams()
	{
		return $this->queryParams;
	}
	
	// Retorna os valores de $_POST em $this->postParams
	public function getPostParams()
	{
		if(isset($this->postParams['_method']))
		{
			unset($this->postParams['_method']);
		}
		
		return $this->postParams;
	}
	
	// Retorna os cabeçalhos da requisição armazenados em $this->headers
	public function getHeaders()
	{
		return $this->headers;
	}
}