<?php
// Configurações do PostgreSQL
define('DB_DRIVER', 'pgsql'); // Alterado para pgsql
define('HOST', 'localhost');
define('PORT', '5432');
define('USER', 'postgres'); // Usuário padrão do Postgres
define('PASS', 'sua_senha');
define('DB', 'e_escolar');

define('BASE_URL', 'http://localhost/e-Escolar/');

if (!isset($_SESSION)) {
    session_start();
}