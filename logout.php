<?php
// Inicia a sessão para ter acesso aos dados atuais
session_start();

// Limpa todas as variáveis de sessão (usuario_id, escola_id, etc)
$_SESSION = array();

// Destrói a sessão no servidor
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Redireciona para a tela de login
header("Location: index.php");
exit;