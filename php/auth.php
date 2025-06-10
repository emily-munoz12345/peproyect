<?php
require_once 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        $stmt = $db->prepare("SELECT id_usuario, username, password, id_rol FROM Usuarios WHERE username = ? AND activo = 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['id_rol'];
            
            header('Location: ../dashboard.html');
            exit();
        } else {
            header('Location: ../login.html?error=1');
            exit();
        }
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header('Location: ../login.html');
    exit();
}
?>