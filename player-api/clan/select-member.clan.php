<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> get('/api/clan/{id}/member', function(Request $req, Response $res){

    $id = $req -> getAttribute('id');

    $SQL_MEMBERS = "SELECT
                        ID,
                        FIRST_NAME,
                        LAST_NAME
                    FROM
                        PLAYER
                    WHERE
                        CLAN_ID = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($SQL_MEMBERS);
        $members = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($members, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }

});
