<?php
    namespace App\Core;

    final class Route {
        private $requestMethod;
        private $pattern;
        private $controller;
        private $method;

        private function __construct(string $requestMethod, string $pattern, string $controller, string $method) {
            $this->requestMethod = $requestMethod;
            $this->pattern = $pattern;
            $this->controller = $controller;
            $this->method = $method;
        }

        public static function get(string $pattern, string $controller, string $method): Route {
            return new Route('GET', $pattern, $controller, $method);
        }

        public static function post(string $pattern, string $controller, string $method): Route {
            return new Route('POST', $pattern, $controller, $method);
        }

        public static function any(string $pattern, string $controller, string $method): Route {
            return new Route('GET|POST', $pattern, $controller, $method);
        }

        public function matches(string $method, string $url): bool {
            if (!preg_match('/^' . $this->requestMethod . '$/', $method)) {
                return false;
            }

            return boolval(preg_match($this->pattern, $url));
        }

        public function getControllerName(): string {
            return $this->controller;
        }

        public function getMethodName(): string {
            return $this->method;
        }

        public function &extractArguments(string $url): array {
            $matches = [];
            $arguments = [];

            preg_match_all($this->pattern, $url, $matches);
            if (isset($matches[1])) {
                $arguments = $matches[1];
            }
            if (isset($matches[2])) {
                $arguments[] = $matches[2][0]; //array_values($matches)[n];
            }
            if (isset($matches[3])) {
                $arguments[] = $matches[3][0]; //array_values($matches)[n];
            }

            return $arguments;
        }

    }