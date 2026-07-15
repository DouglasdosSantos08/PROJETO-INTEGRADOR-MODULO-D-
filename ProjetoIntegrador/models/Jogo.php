<?php

// Informações do banco de dados

class Jogo {
    public $id;
    public $titulo;
    public $categoria;
    public $plataforma;
    public $preco;
    public $imagem;

    // Retorna o preço bonitinho no padrão brasileiro de moeda
    public function precoFormatado() {
        if ($this->preco == 0) {
            return "Grátis";
        }
        return 'R$ ' . number_format($this->preco, 2, ',', '.');
    }
}