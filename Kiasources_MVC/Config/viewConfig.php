<?php

class viewConfig
{
	public $ViewName;
	public $ViewFolder;
	public function __construct($ViewName = null, $ViewFolder = null)
	{
		$this->ViewName = $ViewName;
		$this->ViewFolder = $ViewFolder;
	}
	public function checkView($viewConfig = null)
	{
		$viewFound= false;
		$path = $_SERVER[DOCUMENT_ROOT].'/Kiasources_MVC/Views/'.$viewConfig->ViewFolder;
        $resultsView = scandir($path);
        foreach ($resultsView as $result) 
        {
            if ($result === '.' or $result === '..') continue;
            if ( $viewConfig->ViewName.'.php' == $result ) 
            {
            	$viewFound = true;
            }
        }
		if($viewFound ==false)
		{
        	$viewConfig->ViewName = "index";
        	$viewConfig->ViewFolder = "error";
        }
        return $viewConfig;
	}
}
