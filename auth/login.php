<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../config/config.php";
$errors = null;

if (isset($_POST['submit'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "<script type='application/javascript'>alert('Les champs ne doivent pas être vides')</script>";
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $query = $pdo->query("SELECT password FROM user");
            $query->execute();

            $result = $query->fetch(PDO::FETCH_OBJ);

            if ($result) {
                if (password_verify($password, $result->password)) {
                    $req = $pdo->prepare('SELECT * FROM user WHERE email = :email AND password = :password');
                    $req->execute([
                        ':email' => $email,
                        ':password' => $result->password,
                    ]);

                    $userExists = $req->rowCount();

                    if ($userExists === 1) {
                        $userInfo = $req->fetch(PDO::FETCH_OBJ);
                        $_SESSION['id'] = $userInfo->id;
                        $_SESSION['password'] = $userInfo->password;
                        header('Location: ../index.php?id='.$_SESSION['id']);
                    } else {
                        echo "<h1>email or password incorrect </h1>";
                    }
                } else {
                    echo "<h1>email or password incorrect </h1>";
                }
            }
        }
    }
}