<?php

namespace App\Router;

use ReflectionClass;

class Router
{
    private $routes = [];

    public function discoverControllers($controllerPath)
    {
        $controllerFiles = glob($controllerPath . '/*.php');
        foreach ($controllerFiles as $controllerFile) {
            require_once $controllerFile;
            $className = 'src\\Controllers\\' . basename($controllerFile, '.php');
            $reflectionClass = new ReflectionClass($className);

            foreach ($reflectionClass->getMethods() as $method) {
                $attributes = $method->getAttributes(\App\Router\Route::class);
                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();
                    $routePath = $route->path;

                    $routePath = preg_replace('/{[0-9]+}/', '[0-9]+', $routePath);

                    $this->addRoute($routePath, [$className, $method->getName()]);
                }
            }
        }
    }



    public function addRoute($url, $handler)
    {
        $this->routes[$url] = $handler;
    }

    public function dispatch($url)
    {
        foreach ($this->routes as $route => $handler) {
            $routePattern = preg_replace('/{([a-zA-Z0-9]+)}/', '([a-zA-Z0-9-]+)', $route);
            $routePattern = str_replace('/', '\/', $routePattern);
            $routePattern = '/^' . $routePattern . '$/';

            if (preg_match($routePattern, $url, $matches)) {
                $controller = new $handler[0]();
                $method = $handler[1];

                array_shift($matches);

                call_user_func_array([$controller, $method], $matches);
                return;
            }
        }

        echo "404 Not Found";
    }
}
