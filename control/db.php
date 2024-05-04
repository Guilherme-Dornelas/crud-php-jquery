<?php
// Conexão com o banco de dados (por exemplo, MySQL)
$conn = new mysqli('localhost', 'root', '', 'biblioteca');

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}