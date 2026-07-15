<?php

// Encerra a sessão do usuário, removendo todas as informações armazenadas,
// como ID, nome e outros dados utilizados para manter o login ativo.
session_destroy();

// Redireciona o usuário para a página de login após realizar o logout.
header("Location: /login");

// Encerra a execução do script para garantir que nenhum outro código
exit();