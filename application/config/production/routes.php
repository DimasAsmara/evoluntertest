<?php

defined('BASEPATH') or exit('No direct script access allowed');



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

$route['auth']  = 'auth/controller_ctl';

$route['auth/(:any)'] = 'auth/controller_ctl/$1';

$route['auth/(:any)/(:any)'] = 'auth/controller_ctl/$1/$2';


$route['dashboard']  = 'dashboard/controller_ctl/index';

$route['dashboard/(:any)'] = 'dashboard/controller_ctl/index/$1';

$route['dashboard/(:any)/(:any)'] = 'dashboard/controller_ctl/index/$1/$2';

// MASTER PAGE
$route['master']  = 'master/controller_ctl';

$route['master/(:any)'] = 'master/controller_ctl/$1';

$route['master/(:any)/(:any)'] = 'master/controller_ctl/$1/$2';

$route['master_function']  = 'master/function_ctl';

$route['master_function/(:any)'] = 'master/function_ctl/$1';

$route['master_function/(:any)/(:any)'] = 'master/function_ctl/$1/$2';


// STATISTIK PAGE
$route['statistik']  = 'statistik/controller_ctl';

$route['statistik/(:any)'] = 'statistik/controller_ctl/$1';

$route['statistik/(:any)/(:any)'] = 'statistik/controller_ctl/$1/$2';

// IMPORT PAGE
$route['import']  = 'import/controller_ctl';

$route['import/(:any)'] = 'import/controller_ctl/$1';

$route['import/(:any)/(:any)'] = 'import/controller_ctl/$1/$2';

$route['import_function']  = 'import/function_ctl';

$route['import_function/(:any)'] = 'import/function_ctl/$1';

$route['import_function/(:any)/(:any)'] = 'import/function_ctl/$1/$2';

// CETAK
$route['cetak']  = 'cetak/controller_ctl';

$route['cetak/(:any)'] = 'cetak/controller_ctl/$1';

$route['cetak/(:any)/(:any)'] = 'cetak/controller_ctl/$1/$2';


// MOBILE
$route['mobile']  = 'mobile/controller_ctl';

$route['mobile/(:any)'] = 'mobile/controller_ctl/$1';

$route['mobile/(:any)/(:any)'] = 'mobile/controller_ctl/$1/$2';


// DEFAULT PAGE

$route['default_controller'] = 'auth/controller_ctl';


// MANIPULASI LINK

$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;
