<?php

require_once __DIR__ . '/UserModel.php';
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/../../lib/Response.php';
require_once __DIR__ . '/../../lib/TokenHandler.php';

class AuthController
{
    private UserModel $user_model;

    public function __construct()
    {
        $this->user_model = new UserModel();
    }

    public function login($data)
    {
        $user = $this->user_model->findByUsernameAndPassword($data->username, $data->password);

        if ($user->getId()) {
            $token = TokenHandler::getSignedJWTForUser($user->getUsername());

            return json_encode(array(
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'token' => $token
            ));
        } else {
            return Response::sendWithCode(401, "invalid username or password");
        }
    }

    public function create($data)
    {
        $user = new User();
        $user->setUsername($data->username);
        $user->setPassword($data->password);
        $user->setRole($data->role);

        if ($this->user_model->create($user)) {
            return Response::sendWithCode(201, "new user created");
        } else {
            return Response::sendWithCode(500, "an error");
        }
    }

}
