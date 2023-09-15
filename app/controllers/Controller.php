<?php
namespace app\controllers;

class Controller
{
    protected $container;

    // constructor receives container instance
    public function __construct(\Psr\Container\ContainerInterface $container) {
        $this->container = $container;
    }

   
}