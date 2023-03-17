<?php
namespace App\Http;

class Response
{
	private $httpCode;
	private $contentType;
	private $content;
	private $headers = [];
	
	public function __construct($httpCode, $content, $contentType = 'text/html')
	{
		$this->httpCode = $httpCode;
		$this->content = $content;
		$this->setContentType($contentType);
	}
	
	private function setContentType($contentType)
	{
		$this->contentType = $contentType;
		$this->addHeader('Content-Type', $contentType);
	}
	
	private function addHeader($key, $value)
	{
		$this->headers[$key] = $value;
	}
	
	private function sendHeaders()
	{
		http_response_code($this->httpCode);
		
		foreach($this->headers as $key => $value)
		{
			header($key . ': ' . $value);
			// header('Content-Type: text/html'); - Resultado gerado pelo loop
		}
	}
	
	public function sendResponse()
	{
		$this->sendHeaders();
		
		switch($this->contentType)
		{
			case "application/json" :
				$this->content = json_encode($this->content, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
			break;
			
			default :
				$this->content = $this->content;
			break;
		}
		
		echo $this->content;
		return $this->content;
	}
}