<?php

namespace Core;

class Route
{
    private $routes = [];
    private function getRequestUrl()
    {
        $url_query = explode('?', $_SERVER['REQUEST_URI']);
        $url = str_replace('/aloBridge-function-login/public', '',  $url_query[0]);
        $url = isset($url) ? $url : '/';
        $url = $url === '' || empty($url) ? '/' : $url;
        return $url;
    }

    private function getRequestMethod()
    {
        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
        return $method;
    }

    public function addRoute($method, $url, $action)
    {
        $this->routes[] = [$method, $url, $action];
    }

    public function get($url, $action)
    {
        $this->addRoute('GET', $url, $action);
    }

    public function post($url, $action)
    {
        $this->addRoute('POST', $url, $action);
    }

    public function any($url, $action)
    {
        $this->addRoute('GET || POST', $url, $action);
    }

    public function map()
    {
        $requestURL = $this->getRequestUrl();
        $requestMethod = $this->getRequestMethod();
        $checkRoute = FALSE;
        $params = [];
        foreach ($this->routes as $route) {
            list($method, $url, $action) = $route;

            if (strpos($method, $requestMethod) === FALSE) {
                continue;
            }
            //if url is not in other cases return error
            if ($url === '*') {
                $checkRoute = true;
            } // check case have parameter  
            elseif (strpos($url, '{') === FALSE) {
                if (strcmp(strtolower($requestURL), strtolower($url)) === 0) { //url dont have parameter
                    $checkRoute = true;
                } else {
                    continue;
                }
            } elseif (strpos($url, '}') === FALSE) {
                continue;
            } else {
                $routeParams = explode('/', $url);
                $requestParams = explode('/', $requestURL);
                if (count($routeParams) !== count($requestParams)) {
                    continue;
                }
                $checkurl = true;
                foreach ($routeParams as $key => $rp) {
                    //check parameter
                    if (preg_match('/^{\w+}$/', $rp)) {
                        $params[] = $requestParams[$key];
                        continue;
                    }
                    //check url value without parameter
                    if (strcmp(strtolower($rp), strtolower($requestParams[$key])) !== 0) {
                        $checkurl = false;
                        break;
                    }
                }
                if ($checkurl == false) {
                    continue;
                }
                $checkRoute = true;
            }

            if ($checkRoute == true) {
                if (is_callable($action)) {
                    call_user_func_array($action, $params);
                }
                return;
            }
        }
        return;
    }

    public function run()
    {
        $this->map();
    }


}
