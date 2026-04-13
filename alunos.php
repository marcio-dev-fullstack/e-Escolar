<?php
require_once 'core/Database.php';
if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit; }

$db = Database::getConnection();
$escola_id = (int)$_SESSION['escola_id']; // Forçando inteiro para o Postgres

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
    // No Postgres, é boa prática listar as colunas explicitamente
    $sql = "INSERT INTO alunos (escola_id, nome, email, telefone, status) 
            VALUES (:escola_id, :nome, :email, :telefone, 'ativo')";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'escola_id' => $escola_id,
        'nome'      => $_POST['nome'],
        'email'     => $_POST['email'],
        'telefone'  => $_POST['telefone']
    ]);
}

$alunos = $db->prepare("SELECT * FROM alunos WHERE escola_id = :escola_id ORDER BY nome ASC");
$alunos->execute(['escola_id' => $escola_id]);
$listaAlunos = $alunos->fetchAll();
?>