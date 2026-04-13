<?php
require_once 'core/Database.php';

// Proteção de acesso
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$db = Database::getConnection();
$escola_id = (int)$_SESSION['escola_id'];

try {
    // 1. Buscar dados da Escola logada
    $stmtEscola = $db->prepare("SELECT * FROM escolas WHERE id = :id");
    $stmtEscola->execute(['id' => $escola_id]);
    $dadosEscola = $stmtEscola->fetch();

    // 2. Estatística: Total de Alunos (Filtro Multi-Tenant)
    $stmtAlunos = $db->prepare("SELECT COUNT(id) as total FROM alunos WHERE escola_id = :escola_id");
    $stmtAlunos->execute(['escola_id' => $escola_id]);
    $totalAlunos = $stmtAlunos->fetch()['total'];

    // 3. Estatística: Total de Usuários/Funcionários
    $stmtUsers = $db->prepare("SELECT COUNT(id) as total FROM usuarios WHERE escola_id = :escola_id");
    $stmtUsers->execute(['escola_id' => $escola_id]);
    $totalUsuarios = $stmtUsers->fetch()['total'];

} catch (PDOException $e) {
    die("Erro ao carregar dados do Postgres: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel e-Escolar | <?php echo htmlspecialchars($dadosEscola['nome']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand" href="#">e-Escolar <strong>Postgres</strong></a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3"><i class="bi bi-person-circle"></i> <?php echo $_SESSION['usuario_nome']; ?></span>
                <a href="logout.php" class="btn btn-light btn-sm text-primary fw-bold">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="h4 border-bottom pb-2">Unidade: <?php echo htmlspecialchars($dadosEscola['nome']); ?></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-white p-3 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-primary text-white p-3 rounded">
                            <i class="bi bi-people-fill fs-3"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-0">Total de Alunos</h6>
                            <h3 class="mb-0 fw-bold"><?php echo $totalAlunos; ?></h3>
                        </div>
                    </div>
                    <a href="alunos.php" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-white p-3 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-success text-white p-3 rounded">
                            <i class="bi bi-person-badge-fill fs-3"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-0">Usuários/Staff</h6>
                            <h3 class="mb-0 fw-bold"><?php echo $totalUsuarios; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if($dadosEscola['status'] != 'ativo'): ?>
            <div class="alert alert-warning border-0 shadow-sm">
                <i class="bi bi-exclamation-triangle-fill"></i> 
                Sua unidade está com status: <strong><?php echo strtoupper($dadosEscola['status']); ?></strong>. 
                Contate o suporte do RAZGO.
            </div>
        <?php endif; ?>
    </div>
</body>
</html>