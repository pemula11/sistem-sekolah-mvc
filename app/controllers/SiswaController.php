<?php

namespace app\controllers;
include_once('Controller.php');
use Slim\Views\Twig as View;

class SiswaController extends controller
{

  
  
  public function index($request, $response, $params) {
       // your code
       // to access items in the container... $this->container->get('');
       $data = $this->container->database
       ->select("tbl_member", 
       [ "[>]tbl_sekolah" => ["id_sekolah" => "id"]],
        ["tbl_member.id", "tbl_member.nama", "tbl_member.email", "tbl_sekolah.nama_sekolah"]);
      
    
       return $this->container->view->render($response, 'main/siswa.twig', [
        'data' => $data,
        
        ]);
  }

  public function tambah($request, $response, $params) {
    // your code
    // to access items in the container... $this->container->get('');
   
     $sekolah = $this->container->database->select("tbl_sekolah", ["id",  "nama_sekolah"]);
    return $this->container->view->render($response, 'main/layout/tambah-siswa.twig', [

      
     'id' => $sekolah
     ]);
}

  public function add($request, $response, $params) {
    // your code
    // to access items in the container... $this->container->get('');
    $data =$request->getParams();
    $this->container->database->insert('tbl_member', ['nama' => $data['nama'], 'id_sekolah' => $data['id_sekolah'], 'email' => $data['email']]);
   
    
    $this->container->flash->addMessage('berhasil', 'tambah data');
  return $response->withStatus(302)->withHeader('Location', $this->container->view->baseUrl.'/siswa');
   //var_dump( $data['alamat']);
}

public function edit($request, $response, $params) {
    // your code
    $data= $this->container->database->select("tbl_member",  [ "[>]tbl_sekolah" => ["id_sekolah" => "id"]], 
    ["tbl_member.id", "tbl_member.nama", "tbl_member.email", "tbl_sekolah.nama_sekolah"],
    ["tbl_member.id" => $params]); 
    $id = $this->container->database->select("tbl_sekolah", ["id",  "nama_sekolah"]);

    
    return $this->container->view->render($response, 'main/layout/edit-siswa.twig', [
        'data' => $data,
        'id' => $id
        ]);
}
public function update($request, $response, $params) {
    // your code
    $data =$request->getParams();
    $this->container->database->update('tbl_member',
     ['nama' => $data['nama'], 'id_sekolah' => $data['id_sekolah'], 'email' => $data['email']],
    ['id' => $data['id']]);
    
    $this->container->flash->addMessage('berhasil', 'edit data');
    return $response->withStatus(302)->withHeader('Location',  $this->container->view->baseUrl.'/siswa');
}

public function hapus($request, $response, $params) {
    // your code
    $data =$request->getParams();
    $data= $this->container->database->delete("tbl_member",  [
        "id" => $params
    ]);
    
    
    $this->container->flash->addMessage('berhasil', 'hapus data');
    return $response->withStatus(302)->withHeader('Location', $this->container->view->baseUrl.'/siswa');
}

}
