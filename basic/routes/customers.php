<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../vendor/autoload.php';
require '../config/db.php';

$app = new \Slim\App;

/* get customers */

$app->get('/api/customers',
  function (Request $request, Response $response) {
  $sql = "SELECT * FROM customers"; /* 쿼리문*/
  
  try{
    $db = new db(); /* db 클래스 선언 */
    $db = $db -> connect(); /* db 연결 */
    
    $stmt = $db->query($sql); /* 쿼리실행*/
    $customers = $stmt->fetchAll(PDO::FETCH_OBJ); /*fetchAll 배열로 돌림*/
    /* http://php.net/manual/kr/pdostatement.fetchall.php */
    $db = null; /* null 정의*/
    
    echo json_encode($customers); /* 배열로 담긴 객체를 json으로 인코딩하여 출력*/
    
  } catch(PDOException $e){ /* 인셉션처리*/
    echo '{"error": {"text": '.$e->getMessage().'}'; /* 에러 json을 보냄*/
  }
});

$app->run();