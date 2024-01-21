<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../config/config.php";
$errors = null;

if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        echo "<script type='application/javascript'>alert('Les champs ne doivent pas être vides')</script>";
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $query = $pdo->prepare("SELECT * FROM user WHERE email = :email");
            $query->execute([
                ':email' => $email
            ]);
            $result = $query->fetch();

            if ($result) {
                $errors = "User already exists";
            } else {
                $pass = password_hash($password, PASSWORD_DEFAULT);
                $query = $pdo->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)");

                $query->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':password' => $pass,
                ]);
                header('location:login.html.php');
            }
        } else {
            $errors = "Email not valid";
        }
    }

    if ($errors) {
        echo "<h1>".$errors."</h1>";
    }
}