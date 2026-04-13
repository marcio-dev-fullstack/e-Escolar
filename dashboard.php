<?php
require_once 'core/Database.php';

// Proteção: Se não estiver logado, volta para o login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$db = Database::getConnection();
$escola_id = $_SESSION['escola_id'];

// 1. Buscar dados da Escola logada
$sqlEscola = "SELECT * FROM escolas WHERE id = :id";
$stmtEscola = $db->prepare($sqlEscola);
$stmtEscola->execute(['id' => $escola_id]);
$dadosEscola = $stmtEscola->fetch();

// 2. Exemplo de estatística: Total de Usuários desta escola
$sqlUsers = "SELECT COUNT(*) as total FROM usuarios WHERE escola_id = :escola_id";
$stmtUsers = $db->prepare($sqlUsers);
$stmtUsers->execute(['escola_id' => $escola_id]);
$totalUsuarios = $stmtUsers->fetch()['total'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | <?php echo $dadosEscola['nome']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <span class="navbar-brand">e-Escolar: <?php echo $dadosEscola['nome']; ?></span>
            <div class="d-flex">
                <span class="text-white me-3">Olá, <?php echo $_SESSION['usuario_nome']; ?></span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Usuários Cadastrados</h5>
                        <p class="card-text fs-2"><?php echo $totalUsuarios; ?></p>
                    </div>
                </div>
            </div>
            </div>

        <div class="card">
            <div class="card-header">Informações da Unidade</div>
            <div class="card-body">
                <p><strong>CNPJ:</strong> <?php echo $dadosEscola['cnpj']; ?></p>
                <p><strong>Status da Assinatura:</strong> 
                    <span class="badge bg-success"><?php echo ucfirst($dadosEscola['status']); ?></span>
                </p>
            </div>
        </div>
    </div>
</body>
</html>