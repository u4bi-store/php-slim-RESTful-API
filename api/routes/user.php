<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// get all user
/* http://localhost:8080/slim/api/index.php/api/users */
$app -> get('/api/users', function(Request $req, Response $res){
    echo 'USERS';
});