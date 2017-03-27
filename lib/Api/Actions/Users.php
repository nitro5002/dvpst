<?php

namespace Api\Actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Users extends \Api\Action {

    function __invoke(Request $req, Response $resp) {
        $users = \Api\Users::getUsers();
        $code = $users['error'] ? 500 : 200;
        return self::response($resp, $users['msg'], $code);
    }

}