<?php

namespace Tests;

require_once TESTS_PATH . '/LocalWebTestCase.php';

class ApiTest extends LocalWebTestCase {

    public function setUp() {
        $this->getSlimInstance();
    }

    public function testUsers() {
        $this->get(\Api\Actions\Users::class,'/users');
        $this->assertEquals('200', $this->response->getStatusCode());
        $this->assertEquals('{"status":"ok","message":[]}', (string)$this->response->getBody());
    }

}