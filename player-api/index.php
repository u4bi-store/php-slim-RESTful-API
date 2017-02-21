<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'database/dbcon.php';

$app = new \Slim\App;

require 'player/insert.player.php';  // 플레이어 생성     : POST방식 api/player
require 'player/selects.player.php'; // 플레이어 모두 조회 : GET 방식 api/players

$app->run();