<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> delete('/api/user/{id}', function(Request $req, Response $res){
    
    $id = $req->getAttribute('id');

    $sql = "DELETE FROM user_info WHERE id = $id";

    try{
        // get db obj
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);
        $stmt->execute();
        $db = null;

        echo '{"notice": {"text": "user-info delete"}';
        
    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});