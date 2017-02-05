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

        echo json_encode($customers);   

    } catch(PDOEception $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});