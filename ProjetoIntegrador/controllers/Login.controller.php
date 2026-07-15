<?php

/* ==========================================================
   VERIFICAÇÃO DO MÉTODO HTTP
   Executa o código apenas quando o formulário é enviado
   utilizando o método POST.
========================================================== */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Recebe os dados enviados pelo formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    /* ==========================================================
       VALIDAÇÃO DOS DADOS
       Verifica se o e-mail foi informado corretamente
       e se a senha foi preenchida.
    ========================================================== */
    $validacao = Validacao::validar([
        'email' => ['required', 'email'],
        'senha' => ['required']
    ], $_POST);

    /* ==========================================================
       VERIFICA SE A VALIDAÇÃO FALHOU
       Caso exista algum erro de validação, o usuário é
       redirecionado para a tela de login.
    ========================================================== */
    if ($validacao->naoPassou('login')) {

        header("Location: /login");
        exit();
    }

    /* ==========================================================
       BUSCA O USUÁRIO NO BANCO DE DADOS
       Procura um usuário utilizando o e-mail informado.
    ========================================================== */
    $usuarios = $database->query(
        sql: "select * from usuarios where email = :email",
        class: Usuarios::class,
        params: compact('email')
    )->fetch();

    /* ==========================================================
       VERIFICA SE O USUÁRIO FOI ENCONTRADO
    ========================================================== */
    if ($usuarios) {

        // Senha digitada pelo usuário
        $senhaDoPost = $_POST['senha'];

        // Senha criptografada armazenada no banco
        $senhaDoBanco = $usuarios->senha;

        /* ======================================================
           COMPARAÇÃO DAS SENHAS
           Utiliza password_verify() para comparar a senha
           digitada com a senha criptografada do banco.
        ======================================================= */
        if (!password_verify($senhaDoPost, $senhaDoBanco)) {

            // Armazena mensagem de erro
            flash()->push(
                'validacoes_login',
                ['Usuario ou senha estão incorretos']
            );

            // Retorna para a tela de login
            header('Location: /login');
            exit();
        }

        /* ======================================================
           LOGIN REALIZADO COM SUCESSO
           Armazena os dados do usuário na sessão para
           mantê-lo autenticado.
        ======================================================= */
        $_SESSION['auth'] = $usuarios;

        // Mensagem de boas-vindas
        flash()->push(
            'mensagem',
            "Seja bem vindo " . $_SESSION['auth']->nome
        );

        // Redireciona para a página inicial
        header("Location: /");
        exit();
    }

    /* ==========================================================
       USUÁRIO NÃO ENCONTRADO
       Exibe uma mensagem informando que o e-mail ou senha
       estão incorretos.
    ========================================================== */
    flash()->push(
        'validacoes_login',
        ['Usuario ou senha estão incorretos']
    );

    header('Location: /login');
    exit();
}

/* Caso a página seja acessada pelo navegador sem enviar
   o formulário, apenas carrega a tela de login. */
   
view('login');