<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app ->get('/api/board',
  function(Request $request, Response $response){
    echo 'get board test';
  }
);

$app ->get('/api/check',
  function(Request $request, Response $response){
    echo 'get check test';
  }
);