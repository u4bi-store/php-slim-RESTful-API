<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> put('/api/player/{id}', function(Request $req, Response $res){
    
    $id = $req->getAttribute('id');

    $first_name = $req -> getParam('first_name');
    $last_name  = $req -> getParam('last_name');
    $clan_id    = $req -> getParam('clan_id');
    
    $sql = "UPDATE
                PLAYER
            SET
                FIRST_NAME = :first_name,
                LAST_NAME = :last_name,
                CLAN_ID = :clan_id
            WHERE ID = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':clan_id', $clan_id);
        
        $stmt->execute();

        echo '{"notice": {"text": "player data update success"}';
        
    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});