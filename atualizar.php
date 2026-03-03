<?php
require('conexao.php');

$id            = filter_input(INPUT_GET,  'id',           FILTER_VALIDATE_INT);
$nome          = filter_input(INPUT_POST, 'nome',         FILTER_DEFAULT);
$sobrenome     = filter_input(INPUT_POST, 'sobrenome',    FILTER_DEFAULT);
$setor         = filter_input(INPUT_POST, 'setor',        FILTER_DEFAULT);
$data_admissao = filter_input(INPUT_POST, 'data_admissao',FILTER_DEFAULT);
$data_saida    = filter_input(INPUT_POST, 'data_saida',    FILTER_DEFAULT);
$motivo_saida  = filter_input(INPUT_POST, 'motivo_saida',  FILTER_DEFAULT);

try {
    $sql = "UPDATE `cadastro` 
            SET `nome`=?, `sobrenome`=?, `setor`=?, `data_admissao`=?,
                `data_saida`=?, `motivo_saida`=?
            WHERE `id` = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$nome, $sobrenome, $setor, $data_admissao, $data_saida, $motivo_saida, $id]);
    header('Location: index.php');
    exit();
} catch (PDOException $e) {
    echo 'Ops! Aconteceu um erro: ' . $e->getMessage();
    exit();
}