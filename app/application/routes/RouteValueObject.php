<?php

declare(strict_types=1);

namespace app\application\routes;

class RouteValueObject
{
    private string $method;
    private string $route;
    private string $controller;
    private string $action;

    public function __construct(string $method, string $route, string $controller, string $action)
    {
        $this->method = $method;
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getKey(): string
    {
        return $this->getRoute() . '_' . $this->getMethod();
    }
}