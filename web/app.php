<?php

require __DIR__.'/../vendor/autoload.php';

use App\{
    Entity\User,
    Controller\ExceptionController,
    SecurityManager\SessionHijackingManager
};
use Framework\{
    Http\Response,
    Routing\Router,
    Exception\NotFoundHttpException
};
use DI\ContainerBuilder;

session_start();
session_regenerate_id();

$router = new Router();
$hijackingManager = new SessionHijackingManager();

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(true);
$containerBuilder->addDefinitions('config.php');

$container = $containerBuilder->build();

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if (!isset($_SESSION['user'])) {
    $user = new User();

    $_SESSION['user'] = serialize($user);
}

if ($hijackingManager->check()) {
    $hijackingManager->generate();
} else {
    $response = new Response();

    $response->endSession();
    $response->redirect('/');
}

$router->loadRoutes();
$container->set(Router::class, $router);

try {
    $matchedRoute = $router->getRoute($_SERVER['REQUEST_URI']);
} catch(NotFoundHttpException $exception) {
    $exceptionController = new ExceptionController(new Response());
    $view = $exceptionController->errorAction($exception);

    echo $view;
    exit;
}

$_GET = array_merge($_GET, $matchedRoute->getVars());

$controller = $matchedRoute->getController();
$action = $matchedRoute->getAction();

try {
    $view = $container->call([$controller, $action]);
} catch(\Exception $exception) {
    $exceptionController = new ExceptionController(new Response());
    $view = $exceptionController->errorAction($exception);
}

echo $view;
exit;