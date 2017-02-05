<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'config/database/dbcon.php';

$app = new \Slim\App;

require 'routes/user/user-info.php';

$app->run();