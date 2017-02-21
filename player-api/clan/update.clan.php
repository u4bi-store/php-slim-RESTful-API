<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> put('/api/clan/{id}', function(Request $req, Response $res){
    
    $id = $req->getAttribute('id');

    $name = $req -> getParam('name');
    $nation_id  = $req -> getParam('nation_id');
    
    $sql = "UPDATE
                CLAN
            SET
                NAME = :name,
                NATION_ID = :nation_id
            WHERE CLAN_ID = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':nation_id', $nation_id);
        
        $stmt->execute();

        echo '{"notice": {"text": "clan data update success"}';
        
    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});