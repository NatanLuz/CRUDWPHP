<?php
require('conexao.php');

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$sql = "SELECT * FROM `cadastro` WHERE id = $id";
$statement = $pdo->query($sql);
$result = $statement->fetch(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <title>Detalhes da saída</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header>
        <!-- place navbar here -->
    </header>
    <main class="max-w-xl mx-auto p-4">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-xl font-bold">Dados da saída</h4>
            <a class="rounded bg-red-600 px-3 py-1 text-sm font-semibold text-white hover:bg-red-700" href="/">Sair</a>
        </div>

        <div class="bg-white rounded shadow p-4 space-y-2">
            <p><span class="font-semibold">Nome:</span> <?= $result['nome'] ?></p>
            <p><span class="font-semibold">Sobrenome:</span> <?= $result['sobrenome'] ?></p>
            <p><span class="font-semibold">Setor:</span> <?= $result['setor'] ?? '' ?></p>
            <p><span class="font-semibold">Data de admissão:</span>
                <?= $result['data_admissao'] ? date('d/m/Y', strtotime($result['data_admissao'])) : '' ?></p>
            <p><span class="font-semibold">Data de saída:</span>
                <?= $result['datanasc'] ? date('d/m/Y', strtotime($result['datanasc'])) : '' ?></p>
            <p><span class="font-semibold">Motivo da saída:</span>
                <?= $result['motivo_saida'] ?? '' ?></p>
            <p><span class="font-semibold">Status:</span>
                <?= isset($result['status']) ? ($result['status'] === 'inativo' ? 'Inativo' : 'Ativo') : ($result['datanasc'] ? 'Inativo' : 'Ativo') ?>
            </p>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>