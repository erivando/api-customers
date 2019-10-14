<?php

use function src\slimConfiguration;
use App\Controllers\CustomersController;

$app = new \Slim\App(slimConfiguration());

$app->get('/api/customer', CustomersController::class . ':getCustomers');
$app->post('/api/customer', CustomersController::class . ':insertCustomers');
$app->get('/api/customer/{id}', CustomersController::class . ':listaCustomer');
$app->put('/api/customer/{id}', CustomersController::class . ':updateCustomers');
$app->patch('/api/customer/{id}', CustomersController::class . ':atualizaCustomers');
$app->delete('/api/customer/{id}', CustomersController::class . ':deleteCustomers');

$app->run();