<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> post('/api/clan', function(Request $req, Response $res){
    
    $name        = $req -> getParam('name');
    $nation_id   = $req -> getParam('nation_id');

    $sql = "INSERT INTO
            CLAN(
                NAME,
                NATION_ID
            )
            VALUES(
                :name,
                :nation_id
            )";
    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':nation_id', $nation_id);

        $stmt->execute();

        echo '{"notice": {"text": "clan data insert success"}';

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});