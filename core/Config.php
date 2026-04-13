<?php
// Configurações do Banco de Dados
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'e_escolar');

// Configurações do Sistema
define('BASE_URL', 'http://localhost/e-Escolar/');

// Início da sessão para controle do Multi-Tenant
if (!isset($_SESSION)) {
    session_start();
}