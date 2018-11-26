<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['login'] = 'home/login';
$route['logout']= 'home/logout';

$route['official'] = 'official';
$route['official/selection'] = 'official/selection';
$route['official/selected']  = 'official/selected';
$route['official/division/(:num)'] = 'official/division';

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
