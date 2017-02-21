<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> get('/api/clan/{id}/info', function(Request $req, Response $res){

    $id = $req -> getAttribute('id');

    $SQL_INFO = "SELECT
                c.CLAN_ID,
                c.NAME as CLAN_NAME,
                c.NATION_ID,
                n.NAME as NATION_NAME,
                n.TAX as NATION_TAX
            FROM
                CLAN as c
            INNER JOIN
                NATION as n
            ON
                c.NATION_ID = n.ID
            WHERE
                CLAN_ID = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($SQL_INFO);
        $info = $stmt->fetch(PDO::FETCH_OBJ);
        
        $db = null;
        
        echo json_encode($info, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
  
});
