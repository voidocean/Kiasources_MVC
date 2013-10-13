<?php

require_once $_SERVER[DOCUMENT_ROOT].'/Kiasources_MVC/Config/controllerConfig.php';
require_once $_SERVER[DOCUMENT_ROOT].'/Kiasources_MVC/Config/viewConfig.php';
require_once $_SERVER[DOCUMENT_ROOT].'/Kiasources_MVC/Config/Model/HeaderModel.php';
  /*===============================================*/
 /* search and include correct controller.        */
/*===============================================*/
$_controllerConfig = new controllerConfig();
$controller = new ControllerModel();
$controller = $_controllerConfig->getController($controller);

require_once $controller->name.'.php';
require_once 'errorController.php';

Class Controller
{
    public $_ViewFolder;
    public $_ViewName;
    public $_sharedView;
    public $HInfo;
   
	public function __construct()
	{
		
	}
	
	// function View and Partial_View
	// Calling the view or partial view can be redirect to default page of function or redirect
	// if $ViewConfig is used. example view($model, new viewConfig('index', 'home'))
	// fail to find correct view, the controller will redirect it to error page.
	
    public function View($model, $ViewConfig = null)
    {
    	if($ViewConfig->ViewName !=NULL)
        {
        	
        	$ViewConfig = $ViewConfig->checkView($ViewConfig);
            $this->_ViewName = $ViewConfig->ViewName;
            $this->_ViewFolder = $ViewConfig->ViewFolder;
        }
        $this->_sharedView = $_SERVER[DOCUMENT_ROOT].'/Kiasources_MVC/Views/Shared/myTemplate.php';
        $content = $_SERVER[DOCUMENT_ROOT].'/Kiasources_MVC/Views/'.$this->_ViewFolder.'/'.$this->_ViewName.'.php';
        include $this->_sharedView;
    }
    public function Partial_View($model, $ViewConfig = null)
    {   
        if($ViewConfig->ViewName !=NULL)
        {   
        	$ViewConfig = $ViewConfig->checkView($ViewConfig);
            $this->_ViewName= $ViewConfig->ViewName;
            $this->_ViewFolder = $ViewConfig->ViewFolder;
        }
        include $_SERVER[DOCUMENT_ROOT].'/Kiasources_MVC/Views/'.$this->_ViewFolder.'/'.$this->_ViewName.'.php';
    }
    public function setvariable($method, $parameter = array())
    {
    
    	if (method_exists($this, $method))
    	{

        	 call_user_func_array(array($this, $method), $parameter);
    	}
    }
    public function setheaderinfo($HInfo = null)
    {
    	$this->HInfo = $HInfo;
    }
    public function headerinfo()
    {
    	echo '<META NAME="keywords" CONTENT="'.$this->HInfo->Keywords.'"/>';
    	echo '<META property="description" CONTENT="'.$this->HInfo->Description.'"/>';
        echo '<META property="og:description" CONTENT="'.$this->HInfo->Description.'"/> ';
        echo '<meta property="og:image" content="'.$this->HInfo->Image.'"/>';
        echo '<meta property="og:title" content="'.$this->HInfo->Title.'"/>';
        echo '<meta property="og:url" content="'.$this->HInfo->URL.'"/>';
        echo '<Title>'.$this->HInfo->Title.'</Title>';
    }
    public function checkLogin()
    {
    	session_start();
		if($_SESSION['key']== null)
			header("location:/account");
    }
    
}
