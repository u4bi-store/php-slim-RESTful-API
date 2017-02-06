<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app ->get('/api/account',
  function(Request $request, Response $response){
    echo 'get account test';
  }
);