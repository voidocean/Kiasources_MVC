<?php

require_once $_SERVER[DOCUMENT_ROOT].'/Kiasources_MVC/Config/ControllerModel.php';
class controllerConfig
{	
	public function getController($_controller)
	{
		$_controller->path = explode('/', strtolower($_GET['uri']));
		$_controller->found= false;
		$path = $_SERVER[DOCUMENT_ROOT].'/Kiasources_MVC/Controller/';
        $resultsController = scandir($path);
        foreach ($resultsController as $result) {

            if($_controller->path[0] == '')
            {
                if ($result === '.' or $result === '..') continue;
                if ('homeController.php'== $result ) {
                    $_controller->found = true;
                    $_controller->name = 'homeController';
                }
            }
            else
            {
                if ($result === '.' or $result === '..') continue;
                if ( $_controller->path[0].'Controller.php'== $result ) {
                    $_controller->found = true;
                    $_controller->name = $_controller->path[0].'Controller';
                }
            }
        }
		if($_controller->found==false)
		{
        	$_controller->name = "errorController";
        }
        return $_controller;
	}
	
	public function search()
    {
    	
    	$_controller = new ControllerModel();
        $_controller = $this->getController($_controller);
		
        if($_controller->found == true)
        {
        	
        	$controllerName = $_controller->name;
        	$_checkController = new $controllerName();
			
            if($_controller->path[1] == null)
            {
            
                if($_controller->path[0] == '')
                {
                    
                    $_controller->folderName = 'home';
                }
                else
                {
                    
                    $_controller->folderName = $_controller->path[0] ;
                }
            }
            else
            {
                $_controller->folderName = $_controller->path[0] ;
                $_controller->functionName =  $_controller->path[1];
                if(!method_exists($_checkController, $_controller->functionName))
            	{     
                	$_controller->name = 'errorController';
        			$_controller->folderName = 'error';
        			$_controller->viewName = "index";
        			$_controller->functionName = "index";
        			$_controller->found = false;
            	}
            }
            
        }
        else
        {
        	$_controller->name = 'errorController';
        	$_controller->folderName = 'error';
        	$_controller->viewName = "index";
        	$_controller->functionName = "index";
        	$_controller->found = false;
        }
        return $_controller;
    }
}
