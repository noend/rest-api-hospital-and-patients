<?php

use app\App\Controllers\HospitalsController;
use app\App\Controllers\UsersController;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace('\App\Controllers');

SimpleRouter::get('/', function() {
    return json_encode('Hello world');
});

// Hospitals Routes
SimpleRouter::get('/hospitals', [HospitalsController::class, 'index']);
SimpleRouter::get('/hospitals/{id}', [HospitalsController::class, 'show']);
SimpleRouter::post('/hospitals/create', [HospitalsController::class, 'store']);
SimpleRouter::post('/hospitals/update/{id}', [HospitalsController::class, 'update']);
SimpleRouter::post('/hospitals/delete/{id}', [HospitalsController::class, 'destroy']);

// Users Routes
SimpleRouter::get('/users', [UsersController::class, 'index']);
SimpleRouter::get('/users/{id}', [UsersController::class, 'show']);
SimpleRouter::post('/users/create', [UsersController::class, 'store']);
SimpleRouter::post('/users/update/{id}', [UsersController::class, 'update']);
SimpleRouter::post('/users/delete/{id}', [UsersController::class, 'destroy']);

