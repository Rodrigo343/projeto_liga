# projeto_liga

:dart: O projeto Liga tem como objetivo ser uma API para gerenciamento de coleções e cartas do jogo Magic: The Gathering.

---

## Requisitos para rodar o sistema

:one: Ter Composer, Memcached, PHP e um banco de dados MySQL instalados na máquina.

:two: Utilizar o PHP 8.* ou superior.

---

## Como rodar o sistema

:one: Clonar o projeto dentro de um servidor local (Exemplo: Apache).

:two: Habilitar o Memcached e o banco de dados para utilizar a aplicação.

:three: Executar o script Scripts.sql, o mesmo se encontra na pasta sql. (Contém todo o script do banco mais uma massa de testes.)

:five: Copiar o arquivo .env.example.php e o renomear para .env.

:six: No novo arquivo .env, colocar todas as informações específicas da sua máquina relacionadas ao banco de dados, Memcached e uma secret key para o JWT.

:seven: Executar o comando composer update na pasta do projeto, para que todas as bibliotecas e dependências estejam atualizadas.

:information_source: (Opcional)
No projeto existe o arquivo Lojas_cartas_collection.postman_collection, você pode realizar o import dele no Postman para ter acesso a todas as rotas configuradas. 

Basta somente configurar a variável {{baseUrl}} com o caminho local em que a aplicação está rodando na máquina.

---

## Rotas da API

### Rotas Públicas

/login -> Realiza o login na aplicação e gera o token para as rotas privadas.

/logout -> Realiza o logout da aplicação e inativa o acesso às rotas privadas.

/listaCartas -> Realiza a listagem de todas as cartas existentes com suas respectivas coleções.

---

### Rotas Privadas
/v1 -> versão 1.0 da API

    /grupo_edicao_cartas -> rota para ações relacionadas às Edições das Cartas
        /inserir -> Insere uma Edição de Carta
        /editar -> Edita uma Edição de Carta
        /inativar -> Inativa uma Edição de Carta

---

    /grupo_cartas -> rota para ações relacionadas às Cartas
        /inserir -> Insere uma Carta
        /editar -> Edita uma Carta
        /inativar -> Inativa uma Carta
