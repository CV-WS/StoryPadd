<?php

namespace App\Application;

class Container
{
    private array $services = [];

    // Méthode pour récupérer un service (et le créer si nécessaire)
    public function get(string $className)
    {
        // Si le service existe déjà dans le conteneur, on le retourne
        if (isset($this->services[$className])) {
            return $this->services[$className];
        }

        // Créer une instance avec injection des dépendances
        $reflectionClass = new \ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();

        // Si la classe n'a pas de constructeur, instancier directement
        if (is_null($constructor)) {
            $this->services[$className] = new $className();
        } else {
            // Récupérer les paramètres du constructeur
            $parameters = $constructor->getParameters();
            $dependencies = [];

            foreach ($parameters as $parameter) {
                $dependencyClass = $parameter->getType()->getName();
                $dependencies[] = $this->get($dependencyClass); // Récursif pour injecter les dépendances
            }

            // Instancier la classe avec ses dépendances
            $this->services[$className] = $reflectionClass->newInstanceArgs($dependencies);
        }

        return $this->services[$className];
    }
}
