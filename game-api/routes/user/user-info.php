<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;


$app -> get('/api/users-info', function(Request $req, Response $res){
    $sql = "SELECT * FROM user_info";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($users, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app -> get('/api/user-info/{id}', function(Request $req, Response $res){
    
    $id = $req -> getAttribute('id');

    $sql = "SELECT * FROM user_info WHERE id= $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($customer, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});