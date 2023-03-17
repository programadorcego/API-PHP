<?php
use App\Http\Middlewares\MiddlewareQueue;
use App\Http\Middlewares\Maintenance;

MiddlewareQueue::setMap([
	'maintenance' => Maintenance::class,
	'require-admin-login' => \App\Http\Middlewares\RequireAdminLoginMiddleware::class,
	'require-admin-logout' => \App\Http\Middlewares\RequireAdminLogoutMiddleware::class,
	'jwt' => \App\Http\Middlewares\API\JWTMiddleware::class,
	'cache' => \App\Http\Middlewares\API\CacheMiddleware::class,
]);

MiddlewareQueue::setDefaultMiddlewares(['maintenance']);