<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> get('/api/clans', function(Request $req, Response $res){
    $sql = "SELECT
                *   
            FROM 
                CLAN
            ";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $players = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($players, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
