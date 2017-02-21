<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> get('/api/clan/{id}', function(Request $req, Response $res){

    $json_array = array( "INFO" => null,"MEMBER" => null);

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

        $json_array['INFO'] = $info;

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }

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

        $json_array['MEMBER'] = $members;

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
    
    echo json_encode($json_array, JSON_UNESCAPED_UNICODE); 
});

/*

{
    "INFO":{
        "CLAN_ID":"1",
        "CLAN_NAME":"좋은클랜",
        "NATION_ID":"1",
        "NATION_NAME":"대한민국",
        "NATION_TAX":"2000"
    },
    "MEMBER":[
        {
            "ID":"1",
            "FIRST_NAME":"명재",
            "LAST_NAME":"유"
        },
        {
            "ID":"2",
            "FIRST_NAME":"명돌",
            "LAST_NAME":"김"
        },
        {"
            "ID":"3",
            FIRST_NAME":"명민",
            "LAST_NAME":"박"
        },
        {
            "ID":"5",
            "FIRST_NAME":"남명",
            "LAST_NAME":"유"
        }
    ]
}

*/