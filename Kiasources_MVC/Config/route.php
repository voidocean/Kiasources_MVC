<?php

class Route
{
	private $controller;
    public function __construct($controller)
    {
    	$this->controller = $controller;
    	
    }


    public function submit()
    {

    	if($this->controller->found == true)
    	{

            	$method = $this->controller->name;
                $_Controller = new $method();
                $_Controller->_ViewFolder = $this->controller->folderName;
                if($this->controller->functionName == null)
                {
                    $_Controller->_ViewName = 'index';
                    $_Controller->index();
                }
                else
                {
                	
                    $_Controller->_ViewName = $this->controller->functionName;
                    $viewname = $this->controller->functionName;
                    if($this->controller->path[2] != null)
                    {
                    
                    	for($i=2; $i<count($this->controller->path); $i++)
                    	{
                    		$urls[] = $this->controller->path[$i];
                    	}
                    	
                    	$_Controller->setvariable($this->controller->path[1], $urls);
                    	
                    }
                    else
                    {
                        $_Controller-> $viewname(null);
                    }
            	}
        	
    	}
        else if($this->controller->found == false)
        {
        	$_Controller = new errorController();
        	$_Controller->_ViewFolder = "error";
        	$_Controller->_ViewName = 'index';
            $_Controller->index();
        }
    }
}
    
