<?php
$route->get('api/get_all_clients', '\\App\\Controllers\\API\\ClientController@get_all_clients');
$route->get('api/get_client/{id}', '\\App\\Controllers\\API\\ClientController@get_client');
$route->get('api/get_clients_by_name', '\\App\\Controllers\\API\\ClientController@get_clients_by_name');
$route->get('api/get_clients_by_email', '\\App\\Controllers\\API\\ClientController@get_clients_by_email');
$route->get('api/get_clients_by_male', '\\App\\Controllers\\API\\ClientController@get_clients_by_male');
$route->get('api/get_clients_by_female', '\\App\\Controllers\\API\\ClientController@get_clients_by_female');
$route->post('api/add_client', '\\App\\Controllers\\API\\ClientController@add_client');