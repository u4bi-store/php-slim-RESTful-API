<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../vendor/autoload.php';
require '../config/db.php';
$app = new \Slim\App;


/* index read get 리스트조회*/
$app->get('/api/board',
  function (Request $request, Response $response) {
  $sql = "SELECT * FROM board";
  
  try{
    $db = new db();
    $db = $db -> connect();
    $stmt = $db->query($sql);
    
    $boards = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($boards);
    
  } catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
  }
});


/* show read get 상세조회*/
$app->get('/api/board/{id}',
  function (Request $request, Response $response) {
  $id = $request->getAtrribute('id');
  
  $sql = "SELECT * FROM board WHERE id = $id";

  try{
    $db = new db();
    $db = $db -> connect();
    $stmt = $db->query($sql);
    
    $board = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($board);
    
  } catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
  }
});


/* create create post 생성*/
$app->post('/api/board',
  function (Request $request, Response $response) {
  $name = $request->getParam('name');
  $phone = $request->getParam('phone');
  $vio = $request->getParam('vio');
  
  $sql = "INSERT INFO board(name, phone, vio) VALUES(:name, :phone, :vio)";
  
  try{
    $db = new db();
    $db = $db -> connect();
    
    $psmt = $db->prepare($sql);
  
    $psmt->bindParam(':name', $name);
    $psmt->bindParam(':phone', $phone);
    $psmt->bindParam(':vio', $vio);
    
    $psmt -> execute();
    echo '{"notice": {"text": "customer add"}';
    
  } catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
  }
});


/* update update put 수정*/
$app->put('/api/board/{id}',
  function (Request $request, Response $response) {
  $id = $request->getAtrribute('id');
  
  $name = $request->getParam('name');
  $phone = $request->getParam('phone');
  $vio = $request->getParam('vio');
  
  $sql = "UPDATE board SET
            name  = :name
            phone = :phone
            vio   = :vio
          WHERE id = $id";
  
  try{
    $db = new db();
    $db = $db -> connect();
    
    $psmt = $db->prepare($sql);
    
    $psmt->bindParam(':name', $name);
    $psmt->bindParam(':phone', $phone);
    $psmt->bindParam(':vio', $vio);
    
    $psmt -> execute();
    echo '{"notice": {"text": "customer update"}';
    
  } catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
  }
});


/* destroy delete del 삭제*/
$app->delete('/api/board/delete/{id}',
  function (Request $request, Response $response) {
  $id = $request->getAtrribute('id');
  
  $sql = "DELETE FROM board WHERE id = $id";

  try{
    $db = new db();
    $db = $db -> connect();

    $psmt = $db->prepare($sql);
    $psmt->execute();
    $db = null;
    echo '{"notice": {"text": "customer delete"}';

  } catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
  }
});

$app->run();