<?php

namespace app\controllers;
include_once('Controller.php');
use Slim\Views\Twig as View;

class HomeController extends controller
{

  
  
  public function home($request, $response, $args) {
       // your code
       // to access items in the container... $this->container->get('');
       $sekolah = $this->container->database->count("tbl_sekolah");
       $member = $this->container->database->count("tbl_member");
       return $this->container->view->render($response, 'home.twig', [
        'sekolah' => $sekolah,
        'member' => $member
        
        
        ]);
  }

  public function contact($request, $response, $args) {
       // your code
       // to access items in the container... $this->container->get('');
       return $response;
  }
}
