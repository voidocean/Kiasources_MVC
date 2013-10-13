<?php
  /*===============================================*/
 /* controller class.                             */
/*===============================================*/

// the name of the class should match the view folder name with controller added.
// example:
//  folder name: home
//  controller name: homeController
// default view of the function will be base on the name of the function. if function is index
// then index.php from that view folder will be called if function call view($model, $viewConfig)
// However you can also return other stuff than the view and also call other view then the default view of
// that function with the viewConfig class.
//  use: parent::view($model, new viewConfig(view, foldername))
//  Example: parent::view($model, new viewConfig('tutorial', 'home'))
// to call only the partial view and not including the shared/master layout.
//  use: parent::partial_View($model, new viewConfig(view, foldername))


class homeController extends Controller
{
	public function __construct()
	{
		$HInfo = new HeaderModel();
		$HInfo->Title= 'KiaSources - Home';
		$HInfo->Keywords = 'Personal Site, Home, KIASOURCES';
		$HInfo->Description = 'Personal Site for personal to help further their education';
		$HInfo->URL = 'www.kiasources.com';
		parent::setHeaderInfo($HInfo);
	}
	public function index()
	{
		parent::View(null, null);
	}
}
