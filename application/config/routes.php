<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'errorpage/error404';
$route['translate_uri_dashes'] = FALSE;


$route['thumbnail/img'] = 'home/imagethumbnail';

$route['change-language/(:any)'] = function ($language)
{
	return 'home/changelang/'.$language;
};

$route['page/(:any)'] = function ($page)
{
	return 'home/' . str_replace("-","", $page);
};

$route['detail-article/(:any)/(:any)-viewpost-(:num)'] = function ($module, $article_name, $id)
{
   return 'home/detailarticle/'.$id.'/' . str_replace("-","", $module);
};

$route['detail-project/(:any)/(:any)-viewpost-(:num)'] = function ($module, $article_name, $id)
{
   return 'home/detailproject/'.str_replace("-","", $module).'/' .$id;
};


$route['group-(:any)/(:any)/(:any)-group-(:num)'] = function ($action, $module, $name, $id)
{
	return 'home/' . str_replace("-","", $action) . '/' . str_replace("-","", $module).'/'.$id;
};

$route['articles-(:any)'] = function ($action)
{
	return 'home/' . str_replace("-","", $action);
};


$route['articles-(:any)/(:any)'] = function ($action, $module)
{
	return 'home/' . str_replace("-","", $action) . '/' . str_replace("-","", $module);
};

$route['images-(:any)/(:any)-viewdetail-(:num)'] = function ($action, $module, $id)
{
	return 'home/' . str_replace("-","", $action) . '/' . str_replace("-","", $module)."/".$id;
};

$route['admin/change-laguage/(:any)'] = function ( $language)
{
	return 'admin/changelang/'.$language;
};

$route['admin/manage/(:any)-module-(:any)'] = function ($action, $module)
{
	return 'admin/'.$action.'/'. str_replace("-","", $module);
};

