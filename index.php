<?php
  require 'vendor/autoload.php';
  require_once 'lib/mysql.php';
  require_once 'lib/func.php';

  $app = new \Slim\Slim();

  $app->get('/hello/:name', function($name){
    echo "hello, $name";
  });

  $app->get('/', function(){
    echo "<h1>Go Ahead</h1>";
  });

  $app->get('/users', 'getUsers'); // Using Get HTTP Method and process getUsers function
  $app->get('/users/:id', 'getUser'); // Using Get HTTP Method and process getUser function
  $app->get('/users/search/:query', 'findByName'); // Using Get HTTP Method and process findByName function
  $app->post('/users', 'addUser'); // Using Post HTTP Method and process addUser function
  $app->put('/users/:id', 'updateUser'); // Using Put HTTP Method and process updateUser function
  $app->delete('/users/:id',    'deleteUser'); // Using Delete HTTP Method and process deleteUser function
  $app->run();
?>
