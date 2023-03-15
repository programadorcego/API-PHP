<?php
$route->get('api/get_all_clients', '\\App\\Controllers\\API\\ClientController@get_all_clients', ['jwt']);
$route->get('api/get_client/{id}', '\\App\\Controllers\\API\\ClientController@get_client', ['jwt']);
$route->get('api/get_clients_by_name', '\\App\\Controllers\\API\\ClientController@get_clients_by_name', ['jwt']);
$route->get('api/get_clients_by_email', '\\App\\Controllers\\API\\ClientController@get_clients_by_email', ['jwt']);
$route->get('api/get_clients_by_male', '\\App\\Controllers\\API\\ClientController@get_clients_by_male', ['jwt']);
$route->get('api/get_clients_by_female', '\\App\\Controllers\\API\\ClientController@get_clients_by_female', ['jwt']);
$route->post('api/add_client', '\\App\\Controllers\\API\\ClientController@add_client', ['jwt']);
$route->put('api/edit_client/{id}', '\\App\\Controllers\\API\\ClientController@edit_client', ['jwt']);
$route->delete('api/delete_client/{id}', '\\App\\Controllers\\API\\ClientController@delete_client', ['jwt']);

$route->post('api/login', '\\App\\Controllers\\API\\AuthController@login');