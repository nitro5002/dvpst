<?php

namespace Tests;

class LocalWebTestCase extends \PHPUnit_Framework_TestCase {

    /* @var \Slim\Slim $app */
    protected $app;
    /* @var \Slim\Http\Request $request */
    protected $request;
    /* @var \Slim\Http\Response $response */
    protected $response;

    public function getSlimInstance() {
        $app = '';

        require BASE_PATH . '/public/app.php';

        $this->app = $app;
        return $this->app;
    }

    // Abstract way to make a request to SlimPHP, this allows us to mock the
    // slim environment
    public function request($method, $action, $path, $options = array()) {
        // Capture STDOUT
        ob_start();

        $action = new $action();

        // Prepare a mock environment
        $env = \Slim\Http\Environment::mock(array_merge(array(
            'REQUEST_METHOD' => $method,
            'REQUEST_URI' => $path,
            'SERVER_NAME' => 'localhost',
        ), $options));

        $this->request = \Slim\Http\Request::createFromEnvironment($env);
        $this->response = new \Slim\Http\Response();
        $this->response = $action($this->request, $this->response, []);

        $this->app->run();

        // Return the application output. Also available in `response->body()`
        return ob_get_clean();
    }

    public function get($action, $path, $options = array()) {
        return $this->request('GET', $action, $path, $options);
    }

    public function post($action, $path, $postVars = array(), $options = array()) {
        $options['slim.input'] = http_build_query($postVars);
        return $this->request('POST', $action, $path, $options);
    }

    public function patch($action, $path, $postVars = array(), $options = array()) {
        $options['slim.input'] = http_build_query($postVars);
        return $this->request('PATCH', $action, $path, $options);
    }

    public function put($action, $path, $postVars = array(), $options = array()) {
        $options['slim.input'] = http_build_query($postVars);
        return $this->request('PUT', $action, $path, $options);
    }

    public function delete($action, $path, $options = array()) {
        return $this->request('DELETE', $action, $path, $options);
    }

    public function head($action, $path, $options = array()) {
        return $this->request('HEAD', $action, $path, $options);
    }

}