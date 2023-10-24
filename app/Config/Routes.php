<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/nama', 'Home::nama');
$routes->get('/users', 'Admin\User::index');
$routes->get('/animes', 'guest\AnimeController::animes');
$routes->get('/animes/(:num)', 'guest\AnimeController::animes/$1');
$routes->get('/inputAnime', 'admin\AnimeController::insert');
$routes->post('/saveAnime', 'admin\AnimeController::save');
$routes->get('/detailAnime/(:any)', 'guest\AnimeController::detail/$1');
$routes->get('/editAnime/(:any)', 'admin\AnimeController::edit/$1');
$routes->post('/updateAnime/(:num)', 'admin\AnimeController::update/$1');
$routes->delete('/delete/(:num)', 'admin\AnimeController::delete/$1');
$routes->get('/addGenre', 'admin\GenreController::insert');
$routes->put('/addGenre', 'admin\GenreController::save');
$routes->get('/genres', 'admin\GenreController::genres');
$routes->PUT('/editGenre/(:num)', 'admin\GenreController::edit/$1');
$routes->PUT('/updateGenre/(:num)', 'admin\GenreController::update/$1');
$routes->delete('/deleteGenre/(:num)', 'admin\GenreController::delete/$1');
$routes->get('/genre/(:num)', 'guest\GenreController::getGenre/$1');
$routes->get('/genre/(:num)/(:num)', 'guest\GenreController::getGenre/$1/$2');
$routes->get('rating/(:any)', 'guest\GenreController::rating/$1');

$routes->get('/admin/dashboard', 'admin\AuthController::dashboard');

service('auth')->routes($routes);
