<?php
use App\controllers\HomeController as HomeController;
use App\controllers\SiswaController as SiswaController;
use App\controllers\SekolahController as SekolahController;




$app->get('/', HomeController::class . ':home');

$app->get('/siswa', SiswaController::class . ':index');
$app->get('/tambahsiswa', SiswaController::class . ':tambah');
$app->post('/siswa', SiswaController::class . ':add');
$app->post('/siswa/edit', SiswaController::class . ':update');
$app->get('/siswa/{id}/edit', SiswaController::class . ':edit');
$app->post('/siswa/{id}/hapus', SiswaController::class . ':hapus');

$app->get('/sekolah', SekolahController::class . ':index');
$app->post('/sekolah', SekolahController::class . ':add');
$app->post('/sekolah/edit', SekolahController::class . ':update');
$app->get('/sekolah/{id}/edit', SekolahController::class . ':edit');
$app->post('/sekolah/{id}/hapus', SekolahController::class . ':hapus');

$app->get('/forum', function($requset, $response) {
    return $this->$container;
});

// $app->get('/siswa', function($requset, $response) {
//     $this->view->render($response, 'main/siswa.twig');
// });


