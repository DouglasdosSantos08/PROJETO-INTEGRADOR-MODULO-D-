<?php

// Usei os require_once nos arquivos do MVC
require_once "models/Jogo.php";
require_once "controllers/CatalogoController.php";


// Arquivos da funcionalidade de Suporte
require_once "models/PerguntaFrequente.php";
require_once "models/PerguntaFrequenteRepository.php";
require_once "models/MensagemSuporte.php";
require_once "controllers/SuporteController.php";

session_start(); 

// arquivos do sistema de login
require "Flash.php";
require "function.php";
require "Validacao.php"; 

$config = require 'config.php';
require "database.php";

if (file_exists("models/usuarios.php")) {
    require "models/usuarios.php";
}

// Carregamento do roteador por último
require "route.php";