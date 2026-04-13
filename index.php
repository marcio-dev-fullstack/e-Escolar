<?php
require_once 'core/Database.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha']; // No futuro usaremos password_verify

    $db = Database::getConnection();
    $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':senha', $senha);
    $stmt->execute();

    $usuario = $stmt->fetch();

    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_nivel'] = $usuario['nivel'];
        $_SESSION['escola_id'] = $usuario['escola_id']; // O coração do SaaS

        header("Location: dashboard.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login | e-Escolar SaaS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f6; display: flex; align-items: center; height: 100vh; }
        .login-card { width: 100%; max-width: 400px; margin: auto; padding: 20px; }
    </style>
</head>
<body>
    <div class="login-card card shadow">
        <div class="card-body">
            <h3 class="text-center mb-4">e-Escolar SaaS</h3>
            <?php if($erro): ?>
                <div class="alert alert-danger"><?php echo $erro; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label>E-mail</label>
                    <input type="email" name="email" class="form-control" required placeholder="admin@modelo.com.br">
                </div>
                <div class="mb-3">
                    <label>Senha</label>
                    <input type="password" name="senha" class="form-control" required placeholder="123456">
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar no Sistema</button>
            </form>
        </div>
    </div>
</body>
</html>