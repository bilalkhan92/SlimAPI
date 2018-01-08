<?php

date_default_timezone_set("UTC");
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

require __DIR__ . "/vendor/autoload.php";

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
require __DIR__ . "/config/configs.php";

$app = new \Slim\App(['settings' => $config]);

require __DIR__ . "/config/dependencies.php";
require __DIR__ . "/config/handlers.php";
//require __DIR__ . "/config/middleware.php";

$app->get("/", function ($request, $response, $arguments) {
    $mapper = new UserMapper($this->db);
    $users = $mapper->getUsers();

    $response->getBody()->write(var_export($users, true));
    return $response;
});

$app->get("/{id}", function ($request, $response, $arguments) {
    $user_id = (int)$arguments['id'];
    $mapper = new UserMapper($this->db);
    $users = $mapper->getUserById($user_id);

    $response->getBody()->write(var_export($users, true));
    return $response;
});

$app->post('/user/new', function ($request, $response) {
    $data = $request->getParsedBody();
    //var_dump($data);
    $user_data = [];
    $user_data['FName'] = filter_var($data['FName'], FILTER_SANITIZE_STRING);
    $user_data['LName'] = filter_var($data['LName'], FILTER_SANITIZE_STRING);

    $user = new UserEntity($user_data);
    $user_mapper = new UserMapper($this->db);
    $user_mapper->save($user);
    $response = $response->withRedirect("/sandbox/api/public/");
    return $response;
});


$app->run();


?>
