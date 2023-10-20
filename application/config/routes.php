<?php
namespace Config;

// Create a new instance of our RouteCollection class.
// $routes = Services::routes();
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
|	https://codeigniter.com/userguide3/general/routing.html
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

$route['default_controller'] = 'user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['tasks'] = 'task';
$route['delete'] = 'task';
$route['task/update_status/(:num)'] = 'task/update_status/$1';
$route['task/create'] = 'task/create';
$route['task/update'] = 'task/update';
$route['task/get_task/(:num)'] = 'task/get_task/$1';

$route['users'] = 'user';
$route['user/create'] = 'user/create';
$route['user/get/(:num)'] = 'user/get/$1';
$route['user/update/(:num)'] = 'user/update/$1';
$route['user/delete/(:num)'] = 'user/delete/$1';
$route['user/get_all_users'] = 'user/get_all_users';
$route['user/update'] = 'user/update';
$route['task/get_usernames'] = 'Task/get_usernames';






// $routes->get('tasks', 'Task::index');
