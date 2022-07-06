<?php

session_start();

spl_autoload_register(function($class) {
    $class = str_replace('\\', '/',$class);
    require_once '../app/'.$class.'.php';
});

// Status of debugging shall remain false, unless DependencyContainer is currently in the debugging state
$isDebugging = true;

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

if ($isDebugging) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

try {
    $app = new DependencyContainer(require_once "config/env.php");
    $route = new Router($app, require_once "routes.php");
    echo $route->getPage();
} catch (Exception $exception) {
    if ($isDebugging) {
     echo "<pre>".var_export($exception)."</pre>";
    } else {
        echo "Whooops, something went wrong";
    }

    file_put_contents("../logs/exceptions.log", $exception->getTraceAsString(), FILE_APPEND);
}