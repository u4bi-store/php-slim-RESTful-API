<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> post('/api/player', function(Request $req, Response $res){
    
    $first_name = $req -> getParam('first_name');
    $last_name  = $req -> getParam('last_name');
    $clan_id    = $req -> getParam('clan_id');

    $sql = "INSERT INTO
            PLAYER(
                FIRST_NAME,
                LAST_NAME,
                CLAN_ID
            )
            VALUES(
                :first_name,
                :last_name,
                :clan_id
            )";
    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':clan_id', $clan_id);
        
        $stmt->execute();

        echo '{"notice": {"text": "player data insert success"}';

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});