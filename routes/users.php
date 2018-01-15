<?php
use Response\NotFoundResponse;
use Response\ForbiddenResponse;
use Response\PreconditionFailedResponse;
use Response\PreconditionRequiredResponse;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\DataArraySerializer;


$app->get("/", function ($request, $response, $arguments) {
    $mapper = new UserMapper($this->db);
    $users = $mapper->getUsers();

    /* Serialize the response data. */
   $fractal = new Manager();
   $fractal->setSerializer(new DataArraySerializer);
   $resource = new Collection($users, new UserTransformer);
   $data = $fractal->createData($resource)->toArray();
   return $response->withStatus(200)
       ->withHeader("Content-Type", "application/json")
       ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

});


$app->get("/{id}", function ($request, $response, $arguments) {
    $user_id = (int)$arguments['id'];

    $mapper = new UserMapper($this->db);
    $users = $mapper->getUserById($user_id);
    if ($users == NULL) {
      return new NotFoundResponse("User not found", 404);
    }

    /* Serialize the response data. */
   $fractal = new Manager();
   $fractal->setSerializer(new DataArraySerializer);
   $resource = new Collection($users, new UserTransformer);
   $data = $fractal->createData($resource)->toArray();
   return $response->withStatus(200)
       ->withHeader("Content-Type", "application/json")
       ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});


$app->post('/user/new', function ($request, $response) {
    $data = $request->getParsedBody();

    $keys = array("email", "password");

    if (array_key_exists("email", $data) && array_key_exists("password", $data)) {
      $user_data = [];
      $user_data['email'] = filter_var($data['email'], FILTER_SANITIZE_STRING);
      $user_data['password'] = md5($data['password']);

      $user = new UserEntity($user_data);
      $user_mapper = new UserMapper($this->db);
      $user_mapper->save($user);
      $response = $response->withRedirect("/sandbox/api/public/");
      return $response;
    }else {
      return new PreconditionFailedResponse("Invalid fields specified", 404);
    }
});

?>
