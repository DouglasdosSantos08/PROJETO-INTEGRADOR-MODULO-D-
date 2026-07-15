<?php

// Informações do banco de dados

class JogoPromocao {
    public $id;
    public $titulo;
    public $categoria;
    public $plataforma;
    public $preco_antigo;
    public $preco_atual;
    public $desconto_porcentagem;
    public $imagem;

    // Construtor para facilitar a criação do objeto
    public function __construct($dados = []) {
        $this->id = $dados['id'] ?? null;
        $this->titulo = $dados['titulo'] ?? null;
        $this->categoria = $dados['categoria'] ?? null;
        $this->plataforma = $dados['plataforma'] ?? null;
        $this->preco_antigo = $dados['preco_antigo'] ?? null;
        $this->preco_atual = $dados['preco_atual'] ?? null;
        $this->desconto_porcentagem = $dados['desconto_porcentagem'] ?? null;
        $this->imagem = $dados['imagem'] ?? null;
    }

    // Método para formatar o preço de forma idêntica ao Jogo padrão
    public function precoFormatado() {
        return 'R$ ' . number_format($this->preco_atual, 2, ',', '.');
    }

    public function precoAntigoFormatado() {
        return 'R$ ' . number_format($this->preco_antigo, 2, ',', '.');
    }
}