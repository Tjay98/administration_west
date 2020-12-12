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

//$route['nome da rota que se quer chamar']= 'pasta frontend ou backend / controlador / açao';



//must keep the base route, 404 and translate uri_dashes
$route['default_controller'] = 'frontend/home/';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//new routers here

    //frontend
        //cliente
        $route['clients/login']   =  'frontend/clients/login';
        $route['clients/register']   =  'frontend/clients/register';
        $route['clients/logout']   =  'frontend/clients/logout';
        $route['clients/profile']   =  'frontend/clients/profile';
        $route['clients/password']   =  'frontend/clients/password';
        $route['clients/morada']   =  'frontend/clients/morada';
        $route['clients/purchase_history']   =  'frontend/clients/purchase_history';
    
        //vendas
        $route['sales/history']='frontend/sales/sale_history';
        $route['sales/history/(:any)']= 'frontend/sales/sale_detail/$1';
        $route['add/cart/(:any)']='frontend/sales/add_to_cart/$1';
        $route['remove/cart/(:any)']='frontend/sales/remove_from_cart/$1';
        $route['cart']='frontend/sales/cart';
        $route['checkout']='frontend/sales/orderSuccess/';

        //produtos
        $route['products']   =  'frontend/products/index';
        $route['products/(:any)'] = 'frontend/products/get_products/$1';
        $route['products/search_product']   =  'frontend/products/search_product';
        $route['categories'] = 'frontend/products/categories_index';
        $route['companies'] = 'frontend/products/companies_index';
        $route['categories/(:any)'] = 'frontend/products/products_by_category/$1';

        //contactos
        $route['contacts']   =  'frontend/home/contactos';
        

        //tests
        $route['ola']   =  'frontend/sales/ola_cart';

    //backend
        $route['admin']   =  'backend/dashboard/index';
        $route['admin/login'] = 'backend/dashboard/login';

        //products
        $route['admin/products'] = 'backend/products/index';

        //sales
        $route['admin/sales'] = 'backend/sales/index';


        //categories
        $route['admin/categories'] = 'backend/categories/index';

        //companies
        $route['admin/companies'] = 'backend/companies/index';

    
    //api
        $route['restful/products'] = 'api/restful/get_products';
        $route['restful/products/(:any)'] = 'api/restful/get_product/$1';
        $route['restful/login'] = 'api/restful/login';
        $route['restful/register'] = 'api/restful/register';
       