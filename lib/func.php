<?php
class ResourceNotFoundException extends Exception {}

function getUsers() {
    global $app;
    $sql = "SELECT `name`,`email`,`date`,`ip` FROM restAPI ORDER BY name";
    try {
        $dbCon = getConnection();
        $stmt   = $dbCon->query($sql);
        $users  = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo json_encode(['users' => $users]);
    } catch(PDOException $e) {
        //http_response_code(500);
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}
function getUser($id){
    global $app;
    $sql = "SELECT `name`,`email`,`date`,`ip` FROM restAPI WHERE id=:id";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);
        //$stmt->bindParam(':calories', $calories, PDO::PARAM_INT);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $user = $stmt->fetchObject();
        $dbCon = null;
        if ($user) {
          echo json_encode($user);
        } else {
          throw new ResourceNotFoundException();
        }
    } catch (ResourceNotFoundException $e) {
        $app->log->debug("THIS IS ERRROR");
        $app->response()->status(404);
    } catch(PDOException $e) {
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}
function findByName($query) {
    global $app;
    $sql = "SELECT * FROM restAPI WHERE name LIKE :query ORDER BY name";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);
        $query = "%".$query."%";
        $stmt->bindParam("query", $query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        if ($users) {
          echo json_encode(['users' => $users]);
        } else {
          throw new ResourceNotFoundException();
        }
    } catch (ResourceNotFoundException $e) {
        $app->response()->status(404);
    } catch(PDOException $e) {
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}
function addUser(){
    global $app;
    $input = json_decode($app->request()->getBody());
    $sql = "INSERT INTO restAPI (`name`,`email`,`ip`,`password`,`date`) VALUES (:name, :email, :ip, :password, :dat)";
    try {
        if (!isset($input->name)) {
          throw new Exception('Missing "name" request parameter');
        }
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array(
          ":name"     => $input->name,
          ":email"    => $input->email,
          ":password" => $input->password,
          ":date"     => $input->date,
          ":ip"       => $_SERVER['REMOTE_ADDR']
        ));
        $user = $dbCon->lastInsertId();
        $dbCon = null;
        // or $app->redirect('/users')
        echo json_encode($user);
    } catch(PDOException $e) {
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}
function updateUser($id) {
    global $app;
    $req = $app->request();
    $paramName = $req->params('name');
    $paramEmail = $req->params('email');

    $sql = "UPDATE restAPI SET name=:name, email=:email WHERE id=:id";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);
        $stmt->bindParam("name", $paramName);
        $stmt->bindParam("email", $paramEmail);
        $stmt->bindParam("id", $id);
        $status->status = $stmt->execute();
        $dbCon = null;
        echo json_encode($status);
    } catch(PDOException $e) {
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}
function deleteUser($id) {
    $sql = "DELETE FROM restAPI WHERE id=:id";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);
        $stmt->bindParam("id", $id);
        $status->status = $stmt->execute();
        $dbCon = null;
        echo json_encode($status);
    } catch(PDOException $e) {
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}
