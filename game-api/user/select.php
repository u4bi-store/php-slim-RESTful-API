<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> get('/api/user/{id}', function(Request $req, Response $res){
    
    $id = $req -> getAttribute('id');

    $sql = "SELECT *
            FROM user_info
            WHERE id= $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($user, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});