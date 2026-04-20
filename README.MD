# Sistema de Gestão de Colaboradores em PHP

Aplicação backend em PHP para gerenciamento de colaboradores, com controle de admissão e desligamento e status calculado dinamicamente com base em regras de negócio.

---

## Problema Resolvido

O controle manual de colaboradores ativos e desligados pode gerar inconsistências, principalmente quando o status é armazenado diretamente no banco de dados e depende de atualização manual.

Este projeto resolve esse problema ao centralizar a lógica de status na aplicação, garantindo consistência e eliminando redundância de informação.

---

## Solução Proposta

A aplicação implementa um CRUD de colaboradores onde o status (**Ativo/Inativo**) não é armazenado como coluna no banco de dados, mas derivado dinamicamente a partir da presença ou ausência da `data_saida`.

Essa abordagem:

- reduz inconsistências
- simplifica o modelo de dados
- garante que o estado do colaborador reflita sempre a realidade

---

## Funcionalidades

- Cadastro de colaboradores (admissão)
- Registro de desligamento com data e motivo
- Listagem de colaboradores com status calculado automaticamente
- Filtro por status: **Todos / Ativos / Inativos**
- Ações de visualização, edição e exclusão

---

## Regras de Negócio

- Um colaborador é considerado **Ativo** quando `data_saida` é `NULL`
- Um colaborador é considerado **Inativo** quando `data_saida` está preenchida
- O status não é armazenado, sendo sempre calculado em tempo de execução
- O desligamento exige o preenchimento da data de saída
- O filtro de listagem utiliza a mesma lógica de derivação

---

## Modelo de Dados

Tabela `cadastro`:

- `id` - chave primária
- `nome` - nome do colaborador
- `sobrenome` - sobrenome
- `setor` - departamento
- `data_admissao` - data de entrada
- `data_saida` - data de desligamento (`NULL` indica ativo)
- `motivo_saida` - motivo do desligamento (opcional)

---

## Fluxos da Aplicação

### Admissão de Colaborador

- Realizado via `index.php`
- Campos obrigatórios:
  - Nome
  - Sobrenome
  - Setor
  - Data de admissão
- Resultado: colaborador cadastrado como **ativo**

---

### Registro de Desligamento

- Realizado via `editar.php`
- Preenchimento de:
  - Data de saída
  - Motivo da saída
- Resultado: colaborador passa a ser **inativo**

---

### Listagem e Filtro

- Exibida em `index.php`
- Informações:
  - Nome
  - Setor
  - Status (calculado)
  - Data de saída

Filtros disponíveis via query string:

```text
?status=todos
?status=ativo
?status=inativo
```

---

## Estrutura do Projeto

```text
.
├── index.php   # Cadastro, listagem e filtro
├── editar.php  # Atualização e desligamento
└── img/        # Screenshots da aplicação
```

---

## Tecnologias Utilizadas

- **PHP**: lógica de backend e manipulação de dados
- **MySQL (ou similar)**: persistência de dados
- **HTML/CSS**: interface básica

---

## Possíveis Melhorias

- Validação de dados no backend
- Uso de PDO com prepared statements
- Separação em camadas (service/repository)
- Paginação de resultados
- Autenticação de usuários
- Transformação em API REST

---

## Screenshots

![Tela principal](img/cadastro1.PNG)
![Filtros aplicados](img/cadastro2.PNG)
![Edição](img/cadastro3.PNG)

---

## Autor

**Natan Da Luz**
Desenvolvedor Backend PHP 
Contato: natandaluz01@gmail.com
