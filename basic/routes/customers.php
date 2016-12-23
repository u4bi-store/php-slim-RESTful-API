<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../vendor/autoload.php';
require '../config/db.php';

$app = new \Slim\App;

/* get all customers */
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

/*get single customers*/
$app->get('/api/customers/{id}',
  function (Request $request, Response $response) {
  $id = $request->getAtrribute('id');
  
  $sql = "SELECT * FROM customers WHERE id = $id"; /* 쿼리문*/
  
  try{
    $db = new db(); /* db 클래스 선언 */
    $db = $db -> connect(); /* db 연결 */
    
    $stmt = $db->query($sql); /* 쿼리실행*/
    $customer = $stmt->fetchAll(PDO::FETCH_OBJ); /*fetchAll 배열로 돌림*/
    /* http://php.net/manual/kr/pdostatement.fetchall.php */
    $db = null; /* null 정의*/
    
    echo json_encode($customer); /* 배열로 담긴 객체를 json으로 인코딩하여 출력*/
    
  } catch(PDOException $e){ /* 인셉션처리*/
    echo '{"error": {"text": '.$e->getMessage().'}'; /* 에러 json을 보냄*/
  }
});

/*add customers*/
$app->post('/api/customers/add',
  function (Request $request, Response $response) {
  $name = $request->getParam('name');
  $phone = $request->getParam('phone');
  $vio = $request->getParam('vio');
  
  $sql = "INSERT INFO customers(name, phone, vio) VALUES(:name, :phone, :vio)"; /* 쿼리문*/
  
  try{
    $db = new db(); /* db 클래스 선언 */
    $db = $db -> connect(); /* db 연결 */
    
    $psmt = $db->prepare($sql); /* 프리페어드 쿼리준비함*/
    /* http://php.net/manual/kr/pdo.prepare.php */
    
    $psmt->bindParam(':name', $name);
    $psmt->bindParam(':phone', $phone);
    $psmt->bindParam(':vio', $vio);
    
    $psmt -> execute(); /* 쿼리실행*/
    echo '{"notice": {"text": "customer add"}';
    
  } catch(PDOException $e){ /* 인셉션처리*/
    echo '{"error": {"text": '.$e->getMessage().'}'; /* 에러 json을 보냄*/
  }
});

/* update customer */
$app->put('/api/customers/update/{id}',
  function (Request $request, Response $response) {
  $id = $request->getAtrribute('id');
  
  $name = $request->getParam('name');
  $phone = $request->getParam('phone');
  $vio = $request->getParam('vio');
  
  $sql = "UPDATE customers SET
            name  = :name
            phone = :phone
            vio   = :vio
          WHERE id = $id"; /* 쿼리문*/
  
  try{
    $db = new db(); /* db 클래스 선언 */
    $db = $db -> connect(); /* db 연결 */
    
    $psmt = $db->prepare($sql); /* 프리페어드 쿼리준비함*/
    /* http://php.net/manual/kr/pdo.prepare.php */
    
    $psmt->bindParam(':name', $name);
    $psmt->bindParam(':phone', $phone);
    $psmt->bindParam(':vio', $vio);
    
    $psmt -> execute(); /* 쿼리실행*/
    echo '{"notice": {"text": "customer update"}';
    
  } catch(PDOException $e){ /* 인셉션처리*/
    echo '{"error": {"text": '.$e->getMessage().'}'; /* 에러 json을 보냄*/
  }
});

/* delete customer */
$app->get('/api/customers/delete/{id}',
  function (Request $request, Response $response) {
  $id = $request->getAtrribute('id');
  
  $sql = "DELETE FROM customers WHERE id = $id"; /* 쿼리문*/
  
  try{
    $db = new db(); /* db 클래스 선언 */
    $db = $db -> connect(); /* db 연결 */

    $psmt = $db->prepare($sql); /* 쿼리준비*/
    $psmt->execute(); /* 쿼리실행*/
    $db = null;
    echo '{"notice": {"text": "customer delete"}';

  } catch(PDOException $e){ /* 인셉션처리*/
    echo '{"error": {"text": '.$e->getMessage().'}'; /* 에러 json을 보냄*/
  }
});

$app->run();