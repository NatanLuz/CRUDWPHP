# CRUD em PHP para gestão de colaboradores

Este projeto é um CRUD em PHP com PDO e Tailwind CSS para gestão de colaboradores em uma empresa, focando em **entrada (admissão)** e **saída (desligamento)**.

## Modelo de dados principal

Tabela `cadastro` (campos relevantes):

- `nome` – nome do colaborador
- `sobrenome` – sobrenome do colaborador
- `setor` – setor/departamento
- `data_admissao` – data de entrada na empresa
- `datanasc` – usada aqui como **data de saída** (pode ser NULL enquanto ativo)
- `motivo_saida` – motivo do desligamento (NULL enquanto ativo)
- `status` – `ativo` ou `inativo` (calculado a partir da existência de data de saída)

## Fluxos principais

- **Cadastrar colaborador (entrada)** – feito na tela inicial (`index.php`):
  - Preenche Nome, Sobrenome, Setor e Data de admissão
  - Campos de Data de saída e Motivo da saída podem ficar vazios (colaborador permanece **ativo**)

- **Registrar saída (fim do ciclo)** – feito em `editar.php`:
  - Para um colaborador ativo, informar Data de saída e Motivo da saída
  - O sistema marca o `status` como **inativo**

- **Listar e filtrar** – em `index.php`:
  - Lista todos os colaboradores com Nome, Setor, Status e Data de saída
  - Permite filtrar por **Todos / Ativos / Inativos** via parâmetro `?status=`

## Tecnologias utilizadas

- PHP 8+ (com PDO para acesso ao MySQL)
- MySQL
- Tailwind CSS (via CDN) para  layout das telas