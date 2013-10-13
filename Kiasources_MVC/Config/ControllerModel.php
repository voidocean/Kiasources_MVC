<?php

class ControllerModel
{
	public $uri;
	public $path;
	public $name;
	public $found;
	public $viewName;
	public $folderName;
	public $functionName;
	
	public function __construct()
	{
		$uri = $_GET['uri'];
		$path = explode('/', $_GET['uri']);
		$found = false;
	}
}
