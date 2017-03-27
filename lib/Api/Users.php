<?php

namespace Api;

use \Logger\Logger as Logger;

class Users {

    public static function getUsers() {
        $log = new Logger('users');
        $result = array('error' => false, 'msg' => null);
        try {
            $dvpst = new \Dvpst\Dvpst($log);
            $result['msg'] = $dvpst->getUsers();
        } catch (\Exception $e) {
            $result['msg'] = $e->getMessage();
            $result['error'] = $e->getCode();
        }
        return $result;
    }
}