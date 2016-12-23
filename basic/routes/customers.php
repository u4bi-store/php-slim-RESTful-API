<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../vendor/autoload.php';
require '../config/db.php';

$app = new \Slim\App;

/* get customers */

$app->get('/api/customers',
  function (Request $request, Response $response) {
  echo 'get api customers';
});

$app->run();