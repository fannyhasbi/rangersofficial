<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['login'] = 'home/login';
$route['logout']= 'home/logout';

$route['official'] = 'official';
$route['official/selection'] = 'official/selection';
$route['official/selected']  = 'official/selected';
$route['official/division/(:num)'] = 'official/division/$1';
$route['official/cancel-rangers/(:num)'] = 'official/cancel_rangers/$1';

$route['official/send-email'] = 'official/send_email';

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
