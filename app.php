<?php

date_default_timezone_set('America/Toronto');
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

require __DIR__ . "/routes/users.php";


$app->run();


?>
