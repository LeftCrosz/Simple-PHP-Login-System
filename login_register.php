<?php
session_start();
require_once("config.php");

if(isset($_POST["register"])) {
    $name = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"] ?? 'member';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    
    $checkEmail = $stmt-> get_result();
    if($checkEmail->num_rows > 0) {
        $_SESSION["register_error"] = "Email already exists!";
        $_SESSION["activeForm"] = "register";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt -> bind_param("ssss", $name, $email, $password, $role);
        $stmt -> execute();

    }
    header("Location: index.php");
    exit();
}

if(isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    
    $result = $stmt-> get_result();
    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if(password_verify($password, $user["password"])) {
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_role"] = $user["role"];
            header("Location: user_page.php");
            exit();
        } else {
            $_SESSION["login_error"] = "Incorrect password!";
            $_SESSION["activeForm"] = "login";
            header("Location: index.php");
        }
    } else {
        $_SESSION["login_error"] = "Email not found!";
        $_SESSION["activeForm"] = "login";
        header("Location: index.php");
    }
}

?>