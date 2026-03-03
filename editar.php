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
    <title>Editar saída</title>
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
    <main class="max-w-3xl mx-auto p-4">

        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Editar colaborador / saída</h1>
            <a class="rounded bg-red-600 px-3 py-1 text-sm font-semibold text-white hover:bg-red-700"
                href="index.php">Sair</a>
        </div>

        <form class="space-y-3" action="atualizar.php?id=<?=$result['id']?>" method="post">
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-gray-700" for="nome">Nome</label>
                    <input id="nome" value="<?=$result['nome']?>" autocomplete="off" placeholder="Nome"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="text" name="nome">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-gray-700" for="sobrenome">Sobrenome</label>
                    <input id="sobrenome" value="<?=$result['sobrenome']?>" autocomplete="off" placeholder="Sobrenome"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="text" name="sobrenome">
                </div>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-gray-700" for="setor">Setor</label>
                    <input id="setor" value="<?=$result['setor'] ?? ''?>" autocomplete="off" placeholder="Setor"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="text" name="setor">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-gray-700" for="data_admissao">Data de admissão</label>
                    <input id="data_admissao" value="<?=$result['data_admissao'] ?? ''?>" autocomplete="off"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="date" name="data_admissao">
                    <p class="text-[11px] text-gray-500">Use a mesma data de entrada cadastrada originalmente.</p>
                </div>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-gray-700" for="data_saida">Data de saída</label>
					<input id="data_saida" value="<?=$result['data_saida'] ?? ''?>" autocomplete="off"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
								type="date" name="data_saida">
                    <p class="text-[11px] text-gray-500">Se o colaborador ainda está ativo, deixe este campo em branco. Preencha apenas quando for registrar o desligamento.</p>
                </div>
            </div>
            <textarea name="motivo_saida" placeholder="Motivo da saída"
                class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                rows="3"><?= $result['motivo_saida'] ?? '' ?></textarea>
            <input type="submit" value="Atualizar saída"
                class="rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 cursor-pointer">
        </form>

    </main>
    <footer>
    </footer>
</body>

</html>