<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> put('/api/clan/{clan_id}/member', function(Request $req, Response $res){
    
    $clan_id = $req->getAttribute('clan_id');

    $member_id = $req -> getParam('member_id');

    $sql = "UPDATE
                PLAYER
            SET
                CLAN_ID = :clan_id
            WHERE ID = $member_id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);

        $stmt->bindParam(':clan_id', $clan_id);
        
        $stmt->execute();

        echo '{"notice": {"text": "clan member data update success"}';
        
    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});