<?php

class DB
{
  
    public $db;

    /* ==========================================================
       CONSTRUTOR
       Recebe as configurações de conexão e cria uma instância
       do PDO para permitir o acesso ao banco de dados.
    ========================================================== */
    public function __construct($config)
    {
        // Salva usuário e senha antes de montar o DSN
        $user = $config['user'] ?? 'root';
        $password = $config['password'] ?? '';

        // Cria a conexão com o banco
        $this->db = new PDO(
            $this->getDsn($config),
            $user,
            $password
        );

        // Ativa o modo de exceções para facilitar o tratamento de erros
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /* ==========================================================
       MÉTODO getDsn()
       Monta a string de conexão (DSN) utilizada pelo PDO.
       Exemplo:
       mysql:host=localhost;dbname=Sistema_Login;charset=utf8
    ========================================================== */
    private function getDsn($config)
    {
        $driver = 'mysql';

        // Remove informações que não fazem parte do DSN
        unset($config['driver'], $config['user'], $config['password']);

        // Retorna a string de conexão
        return $driver . ':' . http_build_query($config, '', ';');
    }

    /* ==========================================================
       MÉTODO query()
       Prepara e executa comandos SQL utilizando parâmetros,
       aumentando a segurança contra SQL Injection.
    ========================================================== */
    public function query($sql, $class = null, $params = [])
    {
        // Prepara a consulta
        $prepare = $this->db->prepare($sql);

        // Caso seja informado uma classe, retorna objetos dela
        if ($class) {
            $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        // Executa a consulta passando os parâmetros
        $prepare->execute($params);

        // Retorna o resultado da consulta
        return $prepare;
    }
}

/* ==========================================================
   CONFIGURAÇÃO DA CONEXÃO
   Recupera as configurações do banco e cria uma única conexão
   para ser utilizada em todo o sistema.
========================================================== */

// Caso exista um índice chamado "database", utiliza-o.
// Caso contrário, utiliza diretamente o array de configuração.
$dbConfig = $config['database'] ?? $config;

// Cria a conexão com o banco de dados
$database = new DB($dbConfig);

/* ==========================================================
   FUNÇÃO buscarJogoPorId()
   Busca um único jogo na tabela "jogos" utilizando o ID.
========================================================== */
function buscarJogoPorId($id)
{
    global $database;

    // Executa a consulta
    $stmt = $database->query(
        "SELECT * FROM jogos WHERE id = :id",
        null,
        [':id' => $id]
    );

    // Retorna apenas um registro
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/* ==========================================================
   FUNÇÃO contarTotalJogos()
   Conta quantos jogos existem cadastrados na tabela.
   Utilizada principalmente na paginação.
========================================================== */
function contarTotalJogos()
{
    global $database;

    // Conta todos os registros
    $stmt = $database->query("SELECT COUNT(*) as total FROM jogos");

    // Recupera o resultado
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Retorna o total convertido para inteiro
    return (int)$resultado['total'];
}

/* ==========================================================
   FUNÇÃO buscarJogosPaginados()
   Busca apenas uma quantidade limitada de jogos utilizando
   LIMIT e OFFSET para implementar a paginação.
========================================================== */
function buscarJogosPaginados($limite, $offset)
{
    global $database;

    // Garante que os valores sejam inteiros
    $limiteInt = (int)$limite;
    $offsetInt = (int)$offset;

    // Consulta apenas os registros necessários
    $stmt = $database->query(
        "SELECT * FROM jogos LIMIT $limiteInt OFFSET $offsetInt"
    );

    // Retorna todos os jogos encontrados
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/* ==========================================================
   FUNÇÃO buscarJogoPromocaoPorId()
   Busca um único jogo da tabela "jogos_promocoes"
   utilizando o ID informado.
========================================================== */
function buscarJogoPromocaoPorId($id)
{
    global $database;

    // Executa a consulta
    $stmt = $database->query(
        "SELECT * FROM jogos_promocoes WHERE id = :id",
        null,
        [':id' => $id]
    );

    // Retorna apenas um registro
    return $stmt->fetch(PDO::FETCH_ASSOC);
}