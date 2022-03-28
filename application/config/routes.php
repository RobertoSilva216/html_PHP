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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login']='login';
$route['login/logar']='login/logar';
$route['login/sair']='login/sair';


$route['produtos']='produtos';
$route['produtos/view/(:num)']='produtos/view';
$route['produtos/novo']='produtos/novo';
$route['produtos/novo-do']='produtos/novo_do';
$route['produtos/editar-do']='produtos/editar_do';
$route['produtos/editar/(:num)']='produtos/edicao';
$route['produtos/alterar-status']='produtos/altera_status';



$route['colaboradores']='colaboradores';
$route['colaboradores/novo']='colaboradores/novo';
$route['colaboradores/novo-do']='colaboradores/novo_do';
$route['colaboradores/editar']='colaboradores/editar';
$route['colaboradores/editar-do']='colaboradores/editar_do';
$route['colaboradores/alterar-status']='colaboradores/altera_status';


$route['meus-pedidos']='MeusPedidos';
$route['meus-pedidos/finalizar-pedido']='MeusPedidos/finalizar_pedido';
$route['meus-pedidos/novo']='MeusPedidos/novo';
$route['meus-pedidos/novo-do']='MeusPedidos/novo_do';
$route['meus-pedidos/editar/(:num)']='MeusPedidos/editar';
$route['meus-pedidos/editar-do']='MeusPedidos/editar_do';
$route['meus-pedidos/filtro-item']='MeusPedidos/filtro_item';
$route['meus-pedidos/(:num)']='MeusPedidos/view';


$route['pedidos-compra']='PedidosCompra';
$route['pedidos-compra/(:num)']='PedidosCompra/view';
$route['pedidos-compra/entregar']='PedidosCompra/entregar';

