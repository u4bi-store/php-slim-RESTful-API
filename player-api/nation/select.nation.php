<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> get('/api/nation/{id}', function(Request $req, Response $res){
    
    $id = $req -> getAttribute('id');

    $sql = "SELECT
                *
            FROM
                NATION
            WHERE
                ID = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $nation = $stmt->fetch(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($nation, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});