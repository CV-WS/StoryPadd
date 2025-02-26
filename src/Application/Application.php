<?php

namespace App\Application;

class Application
{
    public static function process()
    {
        $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $params = explode('/', trim($request, '/'));
        $controllerName = "Home";
        $task = "index";

        $params = trim($params[0], ' ') === '' ? null : $params;

        if ($params && !empty($params[0])) {
            $controllerName = ucfirst($params[0]); // Exemple : "Articles"
            $params = array_slice($params, 1); // Reste de l'URL sans le contrôleur
        }

        if ($params && !empty($params[0])) {
            $task = $params[0]; // Exemple : "show"
            $params = array_slice($params, 1); // Le reste des paramètres (par ex., l'ID)
        }

        $controllerName = "\App\Controllers\\" . $controllerName . "Controller";
        $container = new Container();
        $controller = $container->get($controllerName);

        // Obtenir les dépendances de la méthode du contrôleur
        $reflectionMethod = new \ReflectionMethod($controller, $task);
        $methodDependencies = [];

        foreach ($reflectionMethod->getParameters() as $parameter) {
            // Si le paramètre est typé comme une classe, nous l'injectons
            if ($parameter->getType() && !$parameter->getType()->isBuiltin()) {
                $dependencyClass = $parameter->getType()->getName();
                $methodDependencies[] = $container->get($dependencyClass); // Injection via le conteneur
            }
        }

        // Appeler la méthode du contrôleur avec les dépendances injectées et l'ID comme paramètre
        call_user_func_array([$controller, $task], array_merge($methodDependencies, $params ?? []));
    }
}
