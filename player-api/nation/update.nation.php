<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> put('/api/nation/{id}', function(Request $req, Response $res){
    
    $id = $req->getAttribute('id');

    $name = $req -> getParam('name');
    $tax  = $req -> getParam('tax');
    $sql = "UPDATE
                NATION
            SET
                NAME = :name,
                TAX = :tax
            WHERE ID = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tax', $tax);

        $stmt->execute();

        echo '{"notice": {"text": "nation data update success"}';
        
    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});