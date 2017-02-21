<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'database/dbcon.php';

$app = new \Slim\App;

require 'player/insert.player.php';  // 플레이어 생성 : POST방식 api/player

$app->run();