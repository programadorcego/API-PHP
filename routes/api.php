<?php
$route->get('api/clients', '\\App\\Controllers\\API\\ClientController@get_all_clients');
$route->get('api/client/{id}', '\\App\\Controllers\\API\\ClientController@get_client');