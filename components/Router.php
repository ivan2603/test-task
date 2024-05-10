<?php
namespace Components;

use Exception;

class Router {

    private $routes;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $routePath = ROOT.'/config/routes.php';
        $this->routes = include($routePath);
    }


    /**
     * Get url method
     * @return string
     */
    private function getUrl() {

        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Method run
     */
    public function run(){

        $url = $this->getUrl();
        foreach ($this->routes as $urlPattern => $path) {
            if (preg_match("~$urlPattern~", $url)) {

                $internalRoute = preg_replace("~$urlPattern~", $path, $url);
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'.ucfirst(array_shift($segments));
                $parameters = $segments;
                $controllerFile = ROOT. '/app/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                } else {
                    throw new Exception("Controller file $controllerFile not found");
                }
                $controllerName = "App\\Controllers\\$controllerName";
                $controllerObject = new $controllerName();
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    break;
                }
            }
        }
    }
}