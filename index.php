<?php
require_once 'core/Database.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = strtolower(trim($_POST['email'])); // Normalização
    $senha = $_POST['senha'];

    $db = Database::getConnection();
    // Query compatível com Postgres
    $sql = "SELECT id, escola_id, nome, nivel, senha FROM usuarios WHERE LOWER(email) = :email LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    $usuario = $stmt->fetch();

    // No futuro, use password_verify($senha, $usuario['senha'])
    if ($usuario && $senha == $usuario['senha']) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['escola_id'] = $usuario['escola_id'];

        header("Location: dashboard.php");
        exit;
    } else {
        $erro = "Credenciais inválidas para o banco PostgreSQL.";
    }
}
?>