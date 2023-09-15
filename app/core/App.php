<?php

require '../vendor/autoload.php';
session_start();
use Medoo\Medoo;
use Faker\Factory;
$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);


// Get container
$container = $app->getContainer();

$container['database'] = function () {
	return new Medoo([
		'database_type' => 'mysql',
	'database_name' => 'data_sekolah',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
	]); 
};

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__.'/../view', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view['baseUrl'] = $container['request']->getUri()->getBaseUrl();

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    $view->addExtension(new Knlv\Slim\Views\TwigMessages(
        new Slim\Flash\Messages()
    ));
    
    return $view;
};


$app->add(function ($request, $response, $next) {
    $this->view->offsetSet("flash", $this->flash);
    return $next($request, $response);
 });


$container['HomeController'] = function ($container){
    return new \App\controllers\HomeController($container);
};


require 'Route.php';




// $app->get('/tbh', function($request, $response, $args) {
 
// 	$data = $this->database->insert('tbl_sekolah', ['id' => '2', 'nama_sekolah' => 'wkak', 'alamat' => 'ss']);
 
// 	return $response->write(json_encode($data));
// });

// $app->get('/siswaaa', function($request, $response, $args) {
 
// 	$faker = Factory::create('id_ID');
 
//     $id = 2;
   
// $nmsklh = ["Malang", "Binjai", "Bengkulu", "Pekalongan", "Batam", "Ngawi", "Madium", "Purwodadi", "Rembang", "Tuban",
// "Kediri", "Wonogiri", "Kebumen", "Kuningan", "Cirebon", "Subang", "Tangeran", "Subang", "Indramayu", "Sukabumi",
// "Depok", "Cilegon", "Pandeglang", "Metro", "Uton", "Buleleng", "Situbondo", "Banyuwangi", "Banyumas", "Jember",
// "Madura", "Pacitan", "Nusakambangan", "Poso", "sumedang", "Cilacap", "Lumajang", "Bondowoso", "Sragen", "Boyolali"];


//         foreach ($nmsklh as $skol) {
//             for ($i=1; $i <= 5; $i++) { 
            
//                 $nama =  "SMP ".$skol. ' '.$i;
//                 $alamat = $faker->Address;
               
//                 $this->database->insert('tbl_sekolah', ['id' => $id, 'nama_sekolah' => $nama, 'alamat' => $alamat]);
//                  $id++;
//                 }
//         }
       
        
// });

$app->run();

