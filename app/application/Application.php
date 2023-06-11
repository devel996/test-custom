<?php

declare(strict_types=1);

namespace app\application;

use app\application\exceptions\NotFoundException;
use app\application\routes\Router;
use app\application\routes\RouteValueObject;
use Exception;

class Application
{
    public function run(): void
    {
        $this->initializeRouter();

        try {
            $route = Router::get(Request::getMethod(), Request::getUri());
            $controllerInstance = new ($route->getController())();
            $response = call_user_func([$controllerInstance, $route->getAction()]);

            if (!$response instanceof Response && !$response instanceof View) {
                throw new Exception('Invalid Response');
            }

            http_response_code($response->getStatusCode());

            if ($response instanceof View) {
                $file = __DIR__ . '/../modules/' . $response->getFile();
                $params = $response->getParams();

                require $file;
                die;
            }

            echo json_encode($response->getData());
            die;
        } catch (NotFoundException) {
            die('Page not found');
        } catch (Exception $e) {
            die('Invalid configuration');
        }
    }

    private function initializeRouter(): void
    {
        $modulesDirectory = __DIR__ . '/../modules';
        $moduleFolders = scandir($modulesDirectory);
        $routes = [];

        foreach ($moduleFolders as $moduleFolder) {
            if ($moduleFolder === '.' || $moduleFolder === '..') {
                continue;
            }

            $moduleRoutesFile = "{$modulesDirectory}/{$moduleFolder}/routes.php";

            if (file_exists($moduleRoutesFile)) {
                $data = include $moduleRoutesFile;

                $routes = array_merge($routes, $data);
            }
        }

        array_map(function (RouteValueObject $item) {
            Router::addRoute($item);
        }, $routes);
    }
}