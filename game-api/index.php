<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'config/database/dbcon.php';

$app = new \Slim\App;

require 'user/insert.php';  // 유저 생성 : POST방식 api/user
require 'user/selects.php'; // 모두 조회 : GET 방식 api/users
require 'user/select.php';  // 유저 조회 : GET 방식 api/user/{id} @param
require 'user/update.php';  // 유저 수정 : PUT 방식 api/user/{id} @param
require 'user/delete.php';  // 유저 삭제 : DEL 방식 api/user/{id}

require 'object/selects.php'; // 모두 조회 : GET 방식 api/users

$app->run();