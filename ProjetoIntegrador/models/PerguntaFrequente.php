<?php

// Classe que representa uma Pergunta Frequente (FAQ) do sistema.
class PerguntaFrequente
{
    
//    O construtor simplificado cria e define as propriedades da pergunta de uma vez só.
    public function __construct(
        public string $pergunta,
        public string $resposta
    ) {}
}