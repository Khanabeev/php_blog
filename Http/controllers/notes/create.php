<?php

$errors = [];

view("notes/create.view.php", attributes: [
    'heading' => 'Create Note',
    'errors' => $errors
]);
