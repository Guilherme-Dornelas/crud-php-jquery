<?php
include '../control/db.php';

// Verifica o método da requisição
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retorna todos os livros ou um livro específico se um ID for fornecido
    if(isset($_GET['id'])){
        $livroId = $_GET['id'];
        $sql = "SELECT * FROM livros WHERE id = $livroId";
        $result = $conn->query($sql);
        $livro = $result->fetch_assoc();
        echo json_encode($livro);
    } else {
        $livros = array();
        $sql = "SELECT * FROM livros";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $livros[] = $row;
        }
        echo json_encode($livros);
    }
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adiciona um novo livro ao banco de dados
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $ano = $_POST['ano'];
    $sql = "INSERT INTO livros (titulo, autor, genero, ano) VALUES ('$titulo', '$autor', '$genero', $ano)";
    $conn->query($sql);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Atualiza as informações de um livro existente no banco de dados
    parse_str(file_get_contents("php://input"), $put_vars);
    $livroId = $_GET['id'];
    $titulo = $put_vars['titulo'];
    $autor = $put_vars['autor'];
    $genero = $put_vars['genero'];
    $ano = $put_vars['ano'];
    $sql = "UPDATE livros SET titulo='$titulo', autor='$autor', genero='$genero', ano=$ano WHERE id = $livroId";
    $conn->query($sql);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Exclui um livro do banco de dados
    $livroId = $_GET['id'];
    $sql = "DELETE FROM livros WHERE id = $livroId";
    $conn->query($sql);
}

$conn->close();
?>
