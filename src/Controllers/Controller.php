<?php

namespace App\Controllers;

use App\Application\ImportHeadFile;

class Controller
{
    protected function render(string $path, array $variables = [])
    {
        extract($variables);
        ob_start();
        require 'View/' . $path . '.phtml';
        $user = $_SESSION['id'] ?? null;
        $css = $css ??null;
        $js = $js ??null;
        $importFile = new ImportHeadFile('https://'.$_SERVER['HTTP_X_FORWARDED_HOST']);
        $template = ob_get_clean();
        require 'View/layaout.phtml';
        exit;
    }

    protected function redirect(string $controller, string $task, $params = [])
    {
        $resultParam = '';
        foreach ($params as $value) {
            $resultParam .= $value . '/';
        }

        if(count($params) > 0) {
            header('location: /'.ucfirst($controller).'/'.$task.'/'.$resultParam);
        }
        else {
            header('location: /'.ucfirst($controller).'/'.$task);
        }
    }
}
