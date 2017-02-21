<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'database/dbcon.php';

$app = new \Slim\App;

require 'player/insert.player.php';  // 플레이어 생성     : POST방식 api/player @param(first_name, last_name, clan_id)
require 'player/selects.player.php'; // 플레이어 모두 조회 : GET 방식 api/players
require 'player/select.player.php';  // 플레이어 조회     : GET 방식 api/player/{id}
require 'player/update.player.php';  // 플레이어 수정     : PUT 방식 api/player/{id} @param(first_name, last_name, clan_id)
require 'player/delete.player.php';  // 플레이어 삭제     : DEL 방식 api/player/{id}

require 'clan/insert.clan.php';      // 클랜 생성        : POST방식 api/clan @param(name, nation_id)

$app->run();