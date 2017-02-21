<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> get('/api/nations', function(Request $req, Response $res){
    $sql = "SELECT
                *   
            FROM
                NATION";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $nations = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($nations, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
