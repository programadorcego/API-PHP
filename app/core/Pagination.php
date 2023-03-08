<?php
namespace App\Core;

use App\Http\Request;

class Pagination
{
	private $request;
	private $total;
	private $limit;
	private $pages;
	private $currentPage;
	
	public function __construct($total, $currentPage = 1, $limit = 10)
	{
		$this->request = new Request();
		$this->total = $total;
		$this->limit = $limit;
		$this->currentPage = (is_numeric($currentPage) && $currentPage > 0) ? $currentPage : 1;
		$this->calculate();
	}
	
	private function calculate()
	{
		$this->pages = $this-> total > 0 ? ceil($this->total / $this->limit) : 1;
		$this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
	}
	
	public function getLimit()
	{
		$offset = ($this->currentPage - 1) * $this->limit;
		return "{$offset}, {$this->limit}";
	}
	
	public function getNavigation()
	{
		if($this->pages <= 1) return '';
		
		$queryParams = $this->request->getQueryParams();
		$uri = trim($this->request->getUri(), '/');
		$html = "<ul>";
		
		for($i = 1; $i <= $this->pages; $i++)
		{
			$html .= "<li>";
			
			if($this->currentPage != $i)
			{
				$html .= '<a href="'.asset("{$uri}/?" . http_build_query(array_merge($queryParams, ['page' => $i]))).'">';
			}
			
			$html .= $i;
			
			if($this->currentPage != $i)
			{
				$html .= "</a>";
			}
			
			$html .= "</li>";
		}
		
		$html .= "</ul>";
		
		return $html;
	}
}