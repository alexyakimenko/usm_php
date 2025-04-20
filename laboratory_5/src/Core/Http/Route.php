<?php

namespace App\Core\Http;

class Route
{
    /**
     * @var array The registered routes.
     */
    private static array $routes = [];

    /**
     * Registers a route with a callback for a specific HTTP method.
     *
     * @param string $path The route path.
     * @param callable $callback The callback to handle the route.
     * @param string $method The HTTP method (default is 'get').
     * @return void
     */
    public static function route(string $path, callable $callback, string $method = 'get'): void {
        $entries = array_diff(explode('/', trim($path, '/')), ['']);

        $routes_p = &self::$routes;

        foreach ($entries as $entry) {
            if (!isset($routes_p[$entry])) {
                $routes_p[$entry] = [];
            }
            $routes_p = &$routes_p[$entry];
        }

        $routes_p[$method] = $callback;
    }

    /**
     * Registers a GET route.
     *
     * @param string $path The route path.
     * @param callable $callback The callback to handle the route.
     * @return void
     */
    public static function get(string $path, callable $callback): void {
        self::route($path, $callback);
    }

    /**
     * Registers a POST route.
     *
     * @param string $path The route path.
     * @param callable $callback The callback to handle the route.
     * @return void
     */
    public static function post(string $path, callable $callback): void {
        self::route($path, $callback, 'post');
    }

    /**
     * Registers a PUT route.
     *
     * @param string $path The route path.
     * @param callable $callback The callback to handle the route.
     * @return void
     */
    public static function put(string $path, callable $callback): void {
        self::route($path, $callback, 'put');
    }

    /**
     * Registers a PATCH route.
     *
     * @param string $path The route path.
     * @param callable $callback The callback to handle the route.
     * @return void
     */
    public static function patch(string $path, callable $callback): void {
        self::route($path, $callback, 'patch');
    }

    /**
     * Registers a DELETE route.
     *
     * @param string $path The route path.
     * @param callable $callback The callback to handle the route.
     * @return void
     */
    public static function delete(string $path, callable $callback): void {
        self::route($path, $callback, 'delete');
    }

    /**
     * Serves the registered routes based on the current HTTP request.
     *
     * @param callable $fallback The fallback callback if no route matches.
     * @return void
     */
    public static function serve(callable $fallback): void {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $uri = $_SERVER['REQUEST_URI'];

        $parsed_url = parse_url($uri);

        $entries = array_diff(explode('/', trim($parsed_url['path'], '/')), ['']);

        $endpoint = self::$routes;

        foreach ($entries as $entry) {
            if (!isset($endpoint[$entry])) {
                $fallback();
                return;
            }
            $endpoint = $endpoint[$entry];
        }

        if (!isset($endpoint[$method])) {
            $fallback();
            return;
        }

        $req = new Request();
        $req->body = $_POST ?? [];
        $req->params = $_GET ?? [];
        $req->method = $method;

        $endpoint[$method]($req);
    }

    /**
     * Gets the registered routes.
     *
     * @return array The registered routes.
     */
    public static function getRoutes(): array {
        return self::$routes;
    }

    /**
     * Sets the registered routes.
     *
     * @param array $routes The routes to set.
     * @return void
     */
    public static function setRoutes(array $routes): void {
        self::$routes = $routes;
    }
}