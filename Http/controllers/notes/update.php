<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db= App::resolve(Database::class);

$currentUserId = 8;
$errors = [];

$note = $db->query('select * from notes where id=:id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] == $currentUserId);

if (!Validator::string(value: $_POST['body'], min: 1, max: 10)) {
    $errors['body'] = 'A body is required, no more than 10 characters';
}

if (!empty($errors)) {
    view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
    return;
}

$db->query('update notes set body= :body where id=:id', [
    'body' => $_POST['body'],
    'id' => $_POST['id']
]);


header('location: /notes');
exit();
