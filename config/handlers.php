<?php

$container = $app->getContainer();

$container["errorHandler"] = function ($container) {
    return new Slim\Handlers\ApiError($container["logger"]);
};

$container["phpErrorHandler"] = function ($container) {
    return $container["errorHandler"];
};

$container["notFoundHandler"] = function ($container) {
    return new Slim\Handlers\NotFound;
};

 ?>
