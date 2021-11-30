<?php

use Pecee\SimpleRouter\SimpleRouter;

require __DIR__ . "/App/app.php";

try {
    // Start the routing
    SimpleRouter::start();
} catch (\Pecee\Http\Middleware\Exceptions\TokenMismatchException $e) {
    echo '<hr>';
    echo '<pre>';
    var_dump($e->getMessage());
    echo '</pre>';
    echo '<hr>';
    die();
} catch (\Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
    echo '<hr>';
    echo '<pre>';
    var_dump($e->getMessage());
    echo '</pre>';
    echo '<hr>';
    die();
} catch (\Pecee\SimpleRouter\Exceptions\HttpException $e) {
    echo '<hr>';
    echo '<pre>';
    var_dump($e->getMessage());
    echo '</pre>';
    echo '<hr>';
    die();
}

