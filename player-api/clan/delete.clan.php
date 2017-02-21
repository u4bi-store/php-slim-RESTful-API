<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> delete('/api/clan/{id}', function(Request $req, Response $res){
    
    $id = $req->getAttribute('id');

    $sql = "DELETE
            FROM
                CLAN
            WHERE
                CLAN_ID = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);
        $stmt->execute();
        $db = null;

        echo '{"notice": {"text": "clan data delete success"}';
        
    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});