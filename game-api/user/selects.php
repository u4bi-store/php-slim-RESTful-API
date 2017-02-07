<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> get('/api/users', function(Request $req, Response $res){
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