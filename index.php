<?php
require('conexao.php');

$statusFilter = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);

if ($statusFilter === 'ativo') {
    $sql = "SELECT * FROM `cadastro` WHERE data_saida IS NULL ORDER BY nome";
    $statement = $pdo->query($sql);
} elseif ($statusFilter === 'inativo') {
    $sql = "SELECT * FROM `cadastro` WHERE data_saida IS NOT NULL ORDER BY nome";
    $statement = $pdo->query($sql);
} else {
    $sql = "SELECT * FROM `cadastro` ORDER BY nome";
    $statement = $pdo->query($sql);
}

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <title>Saída de colaboradores</title>
    <!--  meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Tailwind via CDN  -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header>
        <!-- place navbar here -->
    </header>
    <main class="max-w-3xl mx-auto p-4">

        <h1 class="text-2xl font-bold mb-4">Cadastro de colaboradores</h1>

        <form class="space-y-3" action="cadastrar.php" method="post">
            <div class="grid gap-3 sm:grid-cols-3">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-gray-700" for="nome">Nome</label>
                    <input id="nome" autocomplete="off" placeholder="Digite o nome"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="text" name="nome">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-gray-700" for="sobrenome">Sobrenome</label>
                    <input id="sobrenome" autocomplete="off" placeholder="Digite o sobrenome"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="text" name="sobrenome">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-gray-700" for="setor">Setor</label>
                    <input id="setor" autocomplete="off" placeholder="Ex.: RH, Fiscal"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="text" name="setor">
                </div>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-gray-700" for="data_admissao">Data de admissão</label>
                    <input id="data_admissao" autocomplete="off"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="date" name="data_admissao">
                    <p class="text-[11px] text-gray-500">Obrigatório. Dia em que o colaborador entrou na empresa.</p>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-gray-700" for="data_saida">Data de saída (opcional)</label>
                    <input id="data_saida" autocomplete="off"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="date" name="data_saida">
                    <p class="text-[11px] text-gray-500">Preencha apenas se o colaborador já saiu. Deixe em branco para
                        manter como ativo.</p>
                </div>
            </div>
            <textarea name="motivo_saida" placeholder="Motivo da saída (preencher apenas se já saiu)"
                class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                rows="3"></textarea>
            <input type="submit" value="Salvar colaborador"
                class="rounded bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700 cursor-pointer">
        </form>

        <hr class="my-4 border-gray-300">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-2 gap-2">
            <h2 class="text-lg font-semibold">Colaboradores cadastrados</h2>
            <div class="flex gap-2 text-sm">
                <?php $sf = $statusFilter ?? ''; ?>
                <a href="index.php"
                    class="px-3 py-1 rounded border <?= $sf === '' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300' ?>">Todos</a>
                <a href="index.php?status=ativo"
                    class="px-3 py-1 rounded border <?= $sf === 'ativo' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300' ?>">Ativos</a>
                <a href="index.php?status=inativo"
                    class="px-3 py-1 rounded border <?= $sf === 'inativo' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300' ?>">Inativos</a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded shadow">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nome</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Setor</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Data de saída</th>
                        <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $row): ?>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-800"><?= $row['nome'] ?></td>
                        <td class="px-4 py-2 text-sm text-gray-800"><?= $row['setor'] ?? '' ?></td>
                        <td class="px-4 py-2 text-sm text-gray-800">
                            <?= $row['data_saida'] ? 'Inativo' : 'Ativo' ?>
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-800">
                            <?= $row['data_saida'] ? date('d/m/Y', strtotime($row['data_saida'])) : '' ?>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex justify-end gap-2">
                                <a class="rounded bg-blue-600 px-3 py-1 text-xs font-semibold text-white hover:bg-blue-700"
                                    href="visualizar.php?id=<?= $row['id'] ?>">Ver</a>
                                <a class="rounded bg-yellow-500 px-3 py-1 text-xs font-semibold text-white hover:bg-yellow-600"
                                    href="editar.php?id=<?= $row['id'] ?>">Editar</a>
                                <a class="rounded bg-red-600 px-3 py-1 text-xs font-semibold text-white hover:bg-red-700"
                                    href="deletar.php?id=<?= $row['id'] ?>">Excluir</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </main>
    <footer>
    </footer>
</body>

</html>