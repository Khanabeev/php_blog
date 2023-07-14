<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/notes/create', 'notes/create.php');
$router->get('/note/edit', 'notes/edit.php');
$router->post('/notes', 'notes/store.php');
$router->get('/note', 'notes/show.php');
$router->patch('/note', 'notes/update.php');
$router->delete('/note', 'notes/destroy.php')->only('auth');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php');

$router->get('/login', 'sessions/create.php')->only('guest');
$router->post('/sessions', 'sessions/store.php')->only('guest');
$router->delete('/sessions', 'sessions/destroy.php')->only('auth');

