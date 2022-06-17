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

$route['default_controller'] = 'page/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['halaman/halaman'] = 'halaman/halaman';
$route['halaman/data'] = 'halaman/data';
$route['halaman/(:num)/(:any)'] = 'page/view/$1/$2';

$route['artikel'] = 'page/indek/artikel';
$route['berita'] = 'page/indek/berita';

$route['artikel/(:num)'] = 'page/indek/artikel/$1';
$route['berita/(:num)'] = 'page/indek/berita/$1';

$route['artikel-detail/(:num)/(:any)'] = 'post/index/$1/$2';
$route['berita-detail/(:num)/(:any)'] = 'post/index/$1/$2';

$route['data-detail/(:num)'] = 'page/dataDetail/$1';
$route['data-detail/(:num)/(:any)'] = 'page/dataDetail/$1/$2';

$route['proses-cari'] = 'page/proses_cari';
$route['proses-temukan'] = 'page/proses_temukan';
$route['cari/(:any)'] = 'page/cari/$1';
$route['temukan/(:any)'] = 'page/temukan/$1';
$route['cari'] = 'page/cari';
$route['temukan'] = 'page/temukan';

$route['profil-organisasi'] = 'page/view/3';
$route['sejarah'] = 'page/view/7';
$route['data'] = 'page/data';
$route['layanan'] = 'page/layanan';
$route['prediksi'] = 'prediksi/index';
$route['galeri-album/foto'] = 'page/galeri/image';
$route['galeri-album/video'] = 'page/galeri/video';
$route['galeri-album/foto/(:num)'] = 'page/galeri/image/$1';
$route['galeri-album/video/(:num)'] = 'page/galeri/video/$1';
$route['index/(:any)'] = 'page/indek/$1';

$route['admin'] = 'login/adminlogin';
$route['operator'] = 'login/operatorlogin';
