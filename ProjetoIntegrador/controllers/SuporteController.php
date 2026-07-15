<?php

class SuporteController
{
    // GET /suporte — exibe as perguntas frequentes e o formulário
    public function index(): void
    {
        // Se o seu repositório não for estático, usamos a instância.
        // Como o seu index.php faz o require de PerguntaFrequenteRepository, podemos instanciá-lo aqui.
        $repository = new PerguntaFrequenteRepository();
        $perguntas = $repository->listarTodas();

        require 'view/suporte.php';
    }

    // POST /suporte — valida e grava a mensagem de contato no banco
    // Alterei o nome para "enviarMensagem" para bater certinho com o que colocamos na rota!
    public function enviarMensagem(): void
    {
        global $database;

        $validacao = Validacao::validar([
            'nome'     => ['required'],
            'email'    => ['required', 'email'],
            'mensagem' => ['required']
        ], $_POST);

        if ($validacao->naoPassou('suporte')) {
            header('Location: /suporte');
            exit;
        }

        $database->query(
            "INSERT INTO mensagens_suporte (nome, email, mensagem) VALUES (:nome, :email, :mensagem)",
            null,
            [
                'nome'     => $_POST['nome'],
                'email'    => $_POST['email'],
                'mensagem' => $_POST['mensagem'],
            ]
        );

        flash()->push('sucesso_suporte', 'Mensagem enviada com sucesso! Nossa equipe vai retornar em breve.');
        header('Location: /suporte');
        exit;
    }
}