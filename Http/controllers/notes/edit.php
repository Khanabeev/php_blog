<?php

use Core\App;
use Core\Database;



$db= App::resolve(Database::class);

$currentUserId = 8;
$errors = [];

$note = $db->query('select * from notes where id=:id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] == $currentUserId);

view("notes/edit.view.php", attributes: [
    'heading' => 'Edit Note',
    'note' => $note
]);
