<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> put('/api/user/{id}', function(Request $req, Response $res){
    
    $id = $req->getAttribute('id');

    $name = $req -> getParam('name');
    $age = $req -> getParam('age');
    $level = $req -> getParam('level');
    $vio = $req -> getParam('vio');
    $team = $req -> getParam('team');
    $skill = $req -> getParam('skill');
    $nation = $req -> getParam('nation');
    
    $sql = "UPDATE user_info SET
            name = :name,
            age = :age,
            level = :level,
            vio = :vio,
            team = :team,
            skill = :skill,
            nation = :nation
        WHERE id = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':vio', $vio);
        $stmt->bindParam(':team', $team);
        $stmt->bindParam(':skill', $skill);
        $stmt->bindParam(':nation', $nation);
        
        $stmt->execute();

        echo '{"notice": {"text": "user-info update"}';
        
    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});