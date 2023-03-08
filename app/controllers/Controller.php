<?php
namespace App\Controllers;

class Controller
{
	protected function render($view, $data = [])
	{
		if(count($data))
		{
			extract($data);
		}
		
		include __DIR__ . '/../../resources/views/' . $view . '.php';
	}
}