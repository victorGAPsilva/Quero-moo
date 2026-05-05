<?php

class Router
{
    private $routes = [];
    private $basePath;

    public function __construct(array $config)
    {
        $this->basePath = rtrim($config['base_path'] ?? '', '/');
    }

    public function add($method, $pattern, $handler)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'pattern' => $pattern,
            'handler' => $handler,
        ];
    }

    public function dispatch($method, $uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);
        if ($this->basePath && strpos($path, $this->basePath) === 0) {
            $path = substr($path, strlen($this->basePath));
        }
        $path = rtrim($path, '/') ?: '/';

        foreach ($this->routes as $route) {
            if ($route['method'] !== strtoupper($method)) {
                continue;
            }

            $pattern = $this->convertPattern($route['pattern']);
            if (preg_match($pattern, $path, $matches)) {
                return $this->invokeHandler($route['handler'], $matches);
            }
        }

        http_response_code(404);
        echo 'Page not found.';
    }

    private function convertPattern($pattern)
    {
        $pattern = rtrim($pattern, '/') ?: '/';
        $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', $pattern);
        return '#^' . $pattern . '$#';
    }

    private function invokeHandler($handler, $params)
    {
        if (is_callable($handler)) {
            return call_user_func($handler, $params);
        }

        if (is_string($handler) && strpos($handler, '@') !== false) {
            list($controllerName, $methodName) = explode('@', $handler);
            if (!class_exists($controllerName)) {
                http_response_code(500);
                echo 'Controller not found.';
                return;
            }

            $controller = new $controllerName();
            if (!method_exists($controller, $methodName)) {
                http_response_code(500);
                echo 'Method not found.';
                return;
            }

            return call_user_func([$controller, $methodName], $params);
        }

        http_response_code(500);
        echo 'Invalid route handler.';
    }
}
