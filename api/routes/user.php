<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// get all user
/* http://localhost:8080/slim/api/index.php/api/users */
$app -> get('/api/users', function(Request $req, Response $res){
    $sql = "SELECT * FROM slimapp";

    try{
        // get db obj
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($customers, JSON_UNESCAPED_UNICODE); 

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// get one user
$app -> get('/api/user/{id}', function(Request $req, Response $res){
    
    $id = $req -> getAttribute('id');

    $sql = "SELECT * FROM slimapp WHERE id= $id";

    try{
        // get db obj
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

// add user
$app -> post('/api/user/add', function(Request $req, Response $res){
    
    $name = $req -> getParam('name');
    $age = $req -> getParam('age');
    $level = $req -> getParam('level');

    $sql = "INSERT INTO slimapp(name, age, level) VALUES(:name, :age, :level)";

    try{
        // get db obj
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':level', $level);
        
        $stmt->execute();

        echo '{"notice": {"text": "user add"}';

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// update user
$app -> put('/api/user/update/{id}', function(Request $req, Response $res){
    
    $id = $req->getAttribute('id');

    $name = $req -> getParam('name');
    $age = $req -> getParam('age');
    $level = $req -> getParam('level');

    $sql = "UPDATE slimapp SET
            name = :name,
            age = :age,
            level = :level
        WHERE id = $id";

    try{
        // get db obj
        $db = new db();
        $db = $db->connect();

        $stmt = $db-> prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':level', $level);
        
        $stmt->execute();

        echo '{"notice": {"text": "user update"}';
        
    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});