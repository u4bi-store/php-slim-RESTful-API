<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> delete('/api/clan/member/{id}', function(Request $req, Response $res){
    
    $id = $req->getAttribute('id');

    $sql = "UPDATE
                PLAYER
            SET
                CLAN_ID = 0
            WHERE
                ID = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);
        $stmt->execute();
        $db = null;

        echo '{"notice": {"text": "clan member data delete success"}';
        
    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});