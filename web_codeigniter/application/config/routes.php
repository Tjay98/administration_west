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

/*

METODO PARA CRIAR UMA ROTA \/

$route['nome da rota que se quer chamar']= 'pasta frontend ou backend / controlador / açao';

*/


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
        $route['clients/morada_shipping']   =  'frontend/clients/morada_shipping';
        $route['clients/morada_billing']   =  'frontend/clients/morada_billing';
        $route['clients/shipping_address'] = 'frontend/clients/get_shipping_address';
        $route['clients/billing_address'] = 'frontend/clients/get_billing_address';
        $route['clients/purchase_history']   =  'frontend/clients/purchase_history';
    
        //vendas
        $route['sales/history']='frontend/sales/sale_history';
        $route['sales/history/(:num)']= 'frontend/sales/sale_detail/$1';
        $route['add/cart/(:num)']='frontend/sales/add_to_cart/$1';
        $route['remove/cart/(:num)']='frontend/sales/remove_from_cart/$1';
        $route['update/cart/quantity/(:num)']='frontend/sales/updateItemQty/$1';
        $route['cart']='frontend/sales/cart';
        $route['sales/checkout']='frontend/sales/checkout/';
        $route['sales/create_sale']='frontend/sales/create_sale';
            

        //produtos
        $route['products']   =  'frontend/products/index';
        $route['products/(:num)'] = 'frontend/products/get_products/$1';
        $route['products/search_product']   =  'frontend/products/search_product';
        $route['categories'] = 'frontend/products/categories_index';
        $route['companies'] = 'frontend/products/companies_index';
        $route['categories/(:num)'] = 'frontend/products/products_by_category/$1';
        $route['companies/(:num)'] = 'frontend/products/products_by_company/$1';

        //contactos
        $route['contacts']   =  'frontend/home/contacts';
        $route['create_contact']   =  'frontend/home/create_contact';
        

    //backend
        $route['admin']   =  'backend/dashboard/index';
        $route['admin/login'] = 'backend/dashboard/login';
        $route['admin/logout'] = 'backend/dashboard/logout';

        //products
        $route['admin/products'] = 'backend/products/index';
        $route['admin/product_table']='backend/products/get_datatable';
        $route['admin/products/add'] = 'backend/products/add';
        $route['admin/products/edit/(:num)'] = 'backend/products/edit/$1';
        $route['admin/products/delete/(:num)'] = 'backend/products/delete/$1';
        $route['admin/products/show/(:num)'] = 'backend/products/show_product/$1';

        //sales
        $route['admin/sales'] = 'backend/sales/index';
        $route['admin/sales_table']='backend/sales/get_datatable';
        $route['admin/sales/add'] = 'backend/sales/add';
        $route['admin/sales/edit/(:num)'] = 'backend/sales/edit/$1';
        $route['admin/sales/delete/(:num)'] = 'backend/sales/delete/$1';
        $route['admin/sales/update_send_status/(:num)'] = 'backend/sales/update_send_status/$1';
        $route['admin/sales/client_address'] = 'backend/sales/client_address';


        //categories
        $route['admin/categories'] = 'backend/categories/index';
        $route['admin/categories_table']='backend/categories/get_datatable';
        $route['admin/categories/add'] = 'backend/categories/add';
        $route['admin/categories/edit/(:num)'] = 'backend/categories/edit/$1';

        //companies
        $route['admin/companies'] = 'backend/companies/index';
        $route['admin/companies_table']='backend/companies/get_datatable';
        $route['admin/companies/add'] = 'backend/companies/add';
        $route['admin/companies/edit/(:num)'] = 'backend/companies/edit/$1';
        $route['admin/companies/delete/(:num)/(:num)'] = 'backend/companies/delete/$1/$2';

        //contacts
        $route['admin/contacts'] = 'backend/contacts/index';
        $route['admin/contact_table']='backend/contacts/get_client_datatable';
        $route['admin/contacts/edit/(:num)'] = 'backend/contacts/edit/$1';
        $route['admin/contacts/delete/(:num)'] = 'backend/contacts/delete/$1';

        //users e clients mesmo controlador
        $route['admin/users'] = 'backend/clients/index';
        $route['admin/user_table']='backend/clients/get_datatable';
        $route['admin/users/add'] = 'backend/clients/user_add';
        $route['admin/users/edit/(:num)'] = 'backend/clients/user_edit/$1';
        $route['admin/users/delete/(:num)'] = 'backend/clients/user_delete/$1';


    
    //api

        //login & register
        $route['restful/login'] = 'api/restful/login';
        $route['restful/register'] = 'api/restful/register';

        //products
        $route['restful/products'] = 'api/restful/get_products';
        $route['restful/products/(:num)'] = 'api/restful/get_product/$1';
        $route['restful/products_company/(:num)'] = 'api/restful/get_products_by_company/$1';
        $route['restful/products_category/(:num)'] = 'api/restful/get_products_by_category/$1';
        $route['restful/search_product/(:any)'] = 'api/restful/search_this_product/$1';

        //companies
        $route['restful/companies'] = 'api/restful/get_companies';
        $route['restful/company/(:num)'] = 'api/restful/get_company/$1';

        //users 
        $route['restful/users/profile'] = 'api/restful/get_profile';
        $route['restful/users/password'] = 'api/restful/change_password';
        $route['restful/users/shipping_address'] = 'api/restful/get_shipping_address';
        $route['restful/users/billing_address'] = 'api/restful/get_billing_address';

        //categories
        $route['restful/categories'] = 'api/restful/get_categories';
        $route['restful/category/(:num)'] = 'api/restful/get_category/$1';

        //sales

        $route['restful/create_sale'] = 'api/restful/create_sale';
        $route['restful/new_create_sale'] = 'api/restful/new_create_sale';
        $route['restful/payment_methods'] = 'api/restful/show_payment_methods';
        

        $route['restful/add_product_cart'] = 'api/restful/add_product_cart';
        $route['restful/delete_product_cart'] = 'api/restful/delete_product_cart';
        $route['restful/view_cart'] = 'api/restful/view_cart';

        $route['restful/create_shipping'] = 'api/restful/create_shipping_address';
        $route['restful/create_billing'] = 'api/restful/create_billing_address';

        $route['restful/show_user_purchases'] = 'api/restful/show_user_purchases';



       