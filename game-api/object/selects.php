<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> get('/api/objects', function(Request $req, Response $res){
    $sql = "SELECT * FROM object_info";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $objects = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($objects, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});