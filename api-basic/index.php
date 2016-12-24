<?php
use \Psr\Http\Message\ServerRequestInterface as Request; /* 요청 리퀘스트 as 별명지어줌*/
use \Psr\Http\Message\ResponseInterface as Response; /* 응답 리스폰스*/

require '../vendor/autoload.php'; /* 인클루딩함 이 줄로 땡겨옴*/
require './routes/board.php';
require './routes/info.php';

$app = new \Slim\App; /* 메인옵젝 app*/


$app->run(); /* 메인*/