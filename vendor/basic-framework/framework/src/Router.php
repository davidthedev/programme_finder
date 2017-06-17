<?php

namespace BasicFramework;

class Router {

    protected $routes = [];
    protected $params = [];

    /**
     * Add routes and parameters
     *
     * @param string $route
     * @param array  $params
     * @return boolean
     */
    public function add($route, $params = [])
    {
        // escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);
        // convert variables {controller}, {action}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        // convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        // add start and end tags
        $route = '/^' . $route . '$/i';
        // add route with params to routes storage
        if ($this->routes[$route] = $params) {
            return true;
        }
        // return false;
    }

    /**
     * Match URI
     *
     * @param  string $uri
     * @return boolean
     */
    protected function match($uri)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $uri, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Dispatch matching routes
     *
     * @param  string $uri
     * @return [type]      [description]
     */
    public function dispatch($uri)
    {

        $uri = $this->removeQueryString($uri);

        if ($this->match($uri)) {
            $controller = $this->params['controller'];
            $controller = ucfirst($controller) . 'Controller';
            $controller = "App\Controllers\\$controller";

            if (class_exists($controller)) {
                $controllerObj = new $controller($this->params);
                $method = !empty($this->params['method']) ? $this->params['method'] : 'index';
                $method = $this->camelCase($method);

                if (is_callable([$controllerObj, $method])) {
                    $controllerObj->$method();
                }
            }
        } else {
            $controller = "App\Controllers\ErrorController";
            $controllerObj = new $controller;
            $method = 'index';
            $method = $this->camelCase($method);
            if (is_callable([$controllerObj, $method])) {
                $controllerObj->$method();
            }
        }
    }

    /**
     * Remove query string form the URI
     *
     * @param  string $uri
     * @return string
     */
    public function removeQueryString($uri)
    {
        if (!empty($uri)) {
            $uriParts = explode('&', $uri);

            if (strpos($uriParts[0], '=') === false) {
                return $uriParts[0];
            } else {
                return '';
            }
        }

        return $uri;
    }

    /**
     * Convert to camel case
     *
     * @param  string $method
     * @return string
     */
    protected function camelCase($method) {
        $method = str_replace('-', ' ', $method);
        $method = ucwords($method);
        $method = str_replace(' ', '', $method);
        return lcfirst($method);
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getParams()
    {
        return $this->params;
    }
}
