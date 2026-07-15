<?php

/* ==========================================================
   Responsável por carregar uma página (View) do sistema.
   Também recebe um array de dados e transforma cada item
   em uma variável para ser utilizada na página.
========================================================== */
function view($view, $data = [])
{
    // Converte cada posição do array em uma variável
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    // Carrega o template principal da aplicação
    require "view/template/app.php";
}

/* ==========================================================
   Exibe o conteúdo de uma ou mais variáveis e encerra
   imediatamente a execução do sistema.
   Muito utilizada durante o desenvolvimento para depuração.
========================================================== */
function dd(...$dump)
{
    dump($dump);
    die();
}

/* ==========================================================
   Exibe o conteúdo de variáveis de forma organizada,
   utilizando a tag <pre> para facilitar a leitura.
========================================================== */
function dump(...$dump)
{
    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
}

/* ==========================================================
   Define um código de erro HTTP (404, 403, 500, etc.),
   carrega a página correspondente e interrompe
   a execução do sistema.
========================================================== */
function abort($code)
{
    // Define o código de resposta HTTP
    http_response_code($code);

    // Carrega a página de erro
    view($code);

    // Encerra a execução
    die();
}

/* ==========================================================
   É utilizada para armazenar mensagens temporárias,
   como sucesso ou erro após envio de formulários.
========================================================== */
function flash()
{
    return new flash;
}

/* ==========================================================
   Carrega o arquivo de configuração do sistema.
   Caso uma chave seja informada, retorna apenas
   aquela configuração específica.
========================================================== */
function config($chave = null)
{
    // Carrega o arquivo config.php
    $config = require 'config.php';

    // Retorna apenas uma configuração específica
    if (strlen($chave) > 0) {
        return $config[$chave];
    }

    // Retorna todas as configurações
    return $config;
}

/* ==========================================================
   Verifica se existe um usuário autenticado na sessão.
   Caso exista, retorna seus dados.
   Caso contrário, retorna null.
========================================================== */
function auth()
{
    // Verifica se o usuário está logado
    if (!isset($_SESSION['auth'])) {
        return null;
    }

    // Retorna os dados do usuário autenticado
    return $_SESSION['auth'];
}