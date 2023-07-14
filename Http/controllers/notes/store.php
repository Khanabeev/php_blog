<?php

use Core\App;
use Core\Database;
use Core\Validator;


$db = App::resolve(Database::class);

$errors = [];

if (!Validator::string(value: $_POST['body'], min: 1, max: 10)) {
    $errors['body'] = 'A body is required, no more than 10 characters';
}

if (!empty($errors)) {
    view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
    return;
}


$db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 8
]);

header('location: /notes');
exit();





