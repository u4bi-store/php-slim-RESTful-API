<?php
use \Psr\Http\Message\ServerRequestInterface as Request; /* 요청 리퀘스트 as 별명지어줌*/
use \Psr\Http\Message\ResponseInterface as Response; /* 응답 리스폰스*/

require 'vendor/autoload.php'; /* 인클루딩함 이 줄로 땡겨옴*/

$app = new \Slim\App; /* 메인옵젝 app*/

/* get 클래스*/
$app->get('/info/{name}', /* info/{name} 으로 받음 */
  function (Request $request, Response $response) { /* 익명으로 펀션 $request 인자주입*/
    $name = $request->getAttribute('name'); /* $name 변수에 name이란 파람값 주입*/
    
    $response->getBody()->write("name : $name"); /* 리스폰스 바디에 받은 파람값 써줌*/
    
  return $response; /* 리턴 리스폰스*/
});

$app->run(); /* 메인*/