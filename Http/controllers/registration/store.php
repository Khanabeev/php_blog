<?php

use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];


// validation

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password, min: 3, max: 10)) {
    $errors['password'] = 'Password should be at least 3 char and less than 10';
}

if (!empty($errors)) {
    view('registration/create.view.php', [
        'errors' => $errors
    ]);

    return;
}

$db = \Core\App::resolve(\Core\Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    header('location: /');
    exit();
} else {
    $db->query('insert into users(email,password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    $_SESSION['user'] = [
        'email' => $email
    ];

    header('location: /');
    exit();
}