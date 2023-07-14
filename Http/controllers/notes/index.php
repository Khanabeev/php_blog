<?php

use Core\App;
use Core\Database;

$_SESSION['name'] = 'Anton';
$db = App::resolve(Database::class);

$heading = "My notes";

$notes = $db->query('select * from notes where user_id=8')->fetchAll();

view("notes/index.view.php", attributes: [
    'heading' => 'My Notes',
    'notes' => $notes
]);
