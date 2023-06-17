<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['/']			         = 'user/dashboard';	
$route['admin']			     = 'admin/dashboard';
$route['admin/laporanspp/(:any)']	= 'admin/laporan/$1';	
$route['admin/laporantabungan/(:any)']	= 'admin/laporan/$1';			
$route['404_override']       = '';
$route['translate_uri_dashes'] = FALSE;
