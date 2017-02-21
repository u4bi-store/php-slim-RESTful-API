<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> get('/api/players', function(Request $req, Response $res){
    $sql = "SELECT
                p.ID,
                p.FIRST_NAME,  
                p.LAST_NAME,  
                c.NAME as CLAN_NAME, 
                n.NAME as NATION_NAME   
            FROM 
                PLAYER as p, 
                NATION as n  
            LEFT JOIN  
                CLAN as c  
            ON  
                c.NATION_ID = n.ID 
            WHERE
                c.CLAN_ID = p.CLAN_ID;";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $players = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($players, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
