<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app -> post('/api/user', function(Request $req, Response $res){
    
    $name = $req -> getParam('name');
    $age = $req -> getParam('age');
    $level = $req -> getParam('level');
    $vio = $req -> getParam('vio');
    $team = $req -> getParam('team');
    $skill = $req -> getParam('skill');
    $nation = $req -> getParam('nation');

    $sql = "INSERT INTO user_info(
                name,
                age,
                level,
                vio,
                team,
                skill,
                nation)
            VALUES(
                :name,
                :age,
                :level,
                :vio,
                :team,
                :skill,
                :nation)";
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

        echo '{"notice": {"text": "user-info add"}';

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});