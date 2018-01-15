<?php

use League\Fractal;
class UserTransformer extends Fractal\TransformerAbstract
{
    public function transform(array $user)
    {
      return [
          'id'      => (int) $user['id'],
          'email'   => $user['email'],
          'password'    => $user['password'],
          'status'    => (int) $user['status']
      ];
    }
}

?>
