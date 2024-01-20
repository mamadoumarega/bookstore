<?php

global $pdo;
require_once "../config/config.php";

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if (isset($_POST['submit'])) {
        if (empty($username) OR empty($email) OR empty($password)) {
            echo "<script type='application/javascript'>alert('Les champs ne doivent pas être vide')</script>";
        } else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $query = $pdo->prepare("SELECT * FROM user WHERE email = ?");
                $query->execute([$email]);
                $result = $query->fetch();

                if ($result) {
                    $errors = "User already exists";
                } else {
                    $pass = password_hash($password, PASSWORD_DEFAULT);
                    $query = $pdo->exec("INSERT INTO user (username,email, password) VALUES('$username','$email','$pass')");

                    if ($query) {
                        $errors = "User registered successfully";
                    } else {
                        $errors = "Error during registration";
                    }
                }
            } else {
                $errors = "Email not valid";
            }
        }

        if ($errors) {
            echo "<h1>".$errors."</h1>";
        }
    }