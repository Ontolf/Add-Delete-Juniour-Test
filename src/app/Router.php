<?php

class Router
{
    /**
     * @var DependencyContainer
     */
    private $app;
    /**
     * @var array
     */
    private $routes;

    /**
     * @param DependencyContainer $app
     * @param array $routes
     */
    public function __construct(DependencyContainer $app, array $routes)
    {
        $this->app = $app;
        $this->routes = $routes;
    }

    /**
     * @return string
     */
    private function compose(): string
    {
        $page = $_SERVER["REQUEST_URI"] ?? null;
        foreach ($this->routes as $route) {
            if ($route['url'] === $page) {
                if ($route['type'] === 'callback') {
                    return $this->getCallback($route['segments']);
                }

                return $this->getController($route['segments']);
            }
        }

        return 404;
    }

    /**
     * @param string $route
     * @return string
     */
    private function getController(string $route): string
    {
        $class = 'Controllers\\'.$route;
        $controller = new $class($this->app, $this->app->requestManager()->getPOST());

        return $controller->execute();
    }

    /**
     * @param $callback
     * @return string
     */
    private function getCallback($callback): string
    {
        return call_user_func($callback, $this->app);
    }

    /**
     * @return string
     */
    public function getPage(): string
    {
        return $this->compose();
    }
}