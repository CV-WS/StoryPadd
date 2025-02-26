<?php
session_start();
use Symfony\Component\VarDumper\VarDumper;
date_default_timezone_set('Europe/Paris');
require 'vendor/autoload.php';
\App\Application\Application::process();