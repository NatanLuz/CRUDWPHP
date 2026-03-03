<?php
require('conexao.php');

try {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$id) {
        echo 'ID inválido para exclusão.';
        exit();
    }

    $sql = "DELETE FROM `cadastro` WHERE id = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$id]);

    header('Location: index.php');
    exit();
} catch (PDOException $e) {
    echo 'Ops! Aconteceu um erro :' . $e->getMessage();
    exit();
}