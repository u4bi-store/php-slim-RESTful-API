<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> post('/api/nation', function(Request $req, Response $res){
    
    $name = $req -> getParam('name');
    $tax  = $req -> getParam('tax');
    $sql = "INSERT INTO
            NATION(
                NAME,
                TAX
            )
            VALUES(
                :name,
                :tax
            )";
    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tax', $tax);
        
        $stmt->execute();

        echo '{"notice": {"text": "clan data insert success"}';

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});