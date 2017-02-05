<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;


$app -> get('/api/users-info', function(Request $req, Response $res){
    $sql = "SELECT * FROM user_info";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($users, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app -> get('/api/user-info/{id}', function(Request $req, Response $res){
    
    $id = $req -> getAttribute('id');

    $sql = "SELECT * FROM user_info WHERE id= $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($customer, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app -> post('/api/user-info/add', function(Request $req, Response $res){
    
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
