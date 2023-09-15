<?php

require __DIR__.'/vendor/autoload.php';
$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__.'/view', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};




$app->get('/', function($requset, $response) {
    $this->view->render($response, 'home.twig');
});

$app->get('/forum', function($requset, $response) {
    return __DIR__;
});


$app->run();



?>