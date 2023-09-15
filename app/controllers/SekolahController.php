<?php

namespace app\controllers;
include_once('Controller.php');
use Slim\Views\Twig as View;

class SekolahController extends controller
{

  
  
  public function index($request, $response, $params) {
       // your code
       // to access items in the container... $this->container->get('');
       $data = $this->container->database->select("tbl_sekolah", "*");
      // $nm = $this->container->database->select("tbl_sekolah", "nama_sekolah");
    //     $id = $this->container->database->select("tbl_sekolah", ["id",  "nama_sekolah"]);;
       return $this->container->view->render($response, 'main/sekolah.twig', [
        'data' => $data,
       
        
        ]);
  }

  public function add($request, $response, $params) {
    // your code
    // to access items in the container... $this->container->get('');
    $data =$request->getParams();
    $this->container->database->insert('tbl_sekolah', ['nama_sekolah' => $data['nama_sekolah'], 'alamat' => $data['alamat']]);
    
   
    $this->container->flash->addMessage('berhasil', 'tambah data');
   return $response->withStatus(302)->withHeader('Location', $this->container->view->baseUrl.'/sekolah');
   //var_dump( $data['alamat']);
}

public function edit($request, $response, $params) {
    // your code
    $data= $this->container->database->select("tbl_sekolah", "*", [
        "id" => $params
    ]);
    
    return $this->container->view->render($response, 'main/layout/edit-sekolah.twig', [
        'data' => $data
        ]);
}
public function update($request, $response, $params) {
    // your code
    $data =$request->getParams();
    $this->container->database->update('tbl_sekolah',
     ['nama_sekolah' => $data['nama_sekolah'], 'alamat' => $data['alamat']],
    ['id' => $data['id']]);
    
    $this->container->flash->addMessage('berhasil', 'edit data');
    return $response->withStatus(200)->withHeader('Location', $this->container->view->baseUrl.'/sekolah');
}

public function hapus($request, $response, $params) {
    // your code
    $data =$request->getParams();
    $data= $this->container->database->delete("tbl_sekolah",  [
        "id" => $params
    ]);
    
    $this->container->flash->addMessage('berhasil', 'hapus data');
    return $response->withStatus(302)->withHeader('Location', $this->container->view->baseUrl.'/sekolah');
}

}