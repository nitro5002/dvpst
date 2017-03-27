<?php

namespace Api;

class Action {

    public static function response($response, $message, $code = 200) {
        $result = array();
        $result['status'] = $code === 200 ? 'ok' : 'error';
        $result['message'] = $message;

        return $response->withJson($result, $code);
    }

}