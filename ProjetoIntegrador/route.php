<?php

// Garante que a sessão está ativa para poder usar session_destroy() e flash()
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Requerer os arquivos necessários do seu projeto
require_once 'controllers/CatalogoController.php';
require_once 'controllers/PromocoesController.php';
require_once 'controllers/SuporteController.php'; // IMPORTADO: Controller do Suporte
require_once 'validacao.php'; // Garante que o seu arquivo de validação está importado

// Captura a URL digitada e limpa a pasta do XAMPP
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = str_replace('/ProjetoIntegrador', '', $url);


// 1. ROTA DE LOGOUT (SAIR DA CONTA)
if ($url === '/logout') {
    session_destroy();
    header('Location: /login');
    exit;
}


// 2. ROTA DA PÁGINA INICIAL / CATÁLOGO
if ($url === '/' || $url === '' || $url === '/catalogo') {
    $controller = new CatalogoController();
    $controller->index();
    exit;
}


// 3. ROTA EXCLUSIVA DE PROMOÇÕES
if ($url === '/promocoes') {
    $controller = new PromocoesController();
    $controller->index();
    exit;
}


// 4. ROTA EXCLUSIVA DE SUPORTE (Adicionada)
if ($url === '/suporte') {
    $controller = new SuporteController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Se o usuário preencheu o formulário de suporte e enviou
        $controller->enviarMensagem();
    } else {
        // Acesso comum para visualizar a página de suporte e FAQs
        $controller->index();
    }
    exit;
}


// 5. ROTA DE LOGIN E REGISTRO (Usando a sua classe Validacao)
if ($url === '/login') {
    
    // Acesso à página (GET)
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require "view/Login.view.php";
        exit;
    }
    
    // Envio de formulários (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // SE TIVER O CAMPO 'NOME' SIGNIFICA QUE VEIO DO FORMULÁRIO DE REGISTRO
        if (isset($_POST['nome'])) {
            
            // CHAMA A SUA CLASSE DE VALIDAÇÃO PRÓPRIA
            $validacao = Validacao::validar([
                'nome'  => ['required'],
                'email' => ['required', 'email', 'unique:usuarios', 'confirmed'],
                'senha' => ['required', 'min:8', 'strong', 'uppercase']
            ], $_POST);

            // Se as regras falharem, joga os erros na sessão e para a execução
            if ($validacao->naoPassou()) {
                header('Location: /login');
                exit;
            }

            // Código de persistência no Banco de Dados
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senhaHash = password_hash($_POST['senha'], PASSWORD_BCRYPT);

            $database->query(
                "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)",
                null,
                [
                    'nome'  => $nome,
                    'email' => $email,
                    'senha' => $senhaHash
                ]
            );

            header('Location: /login?mensagem=Cadastro realizado com sucesso!');
            exit;

        } else {
            // CASO CONTRÁRIO, É UM LOGIN
            $validacao = Validacao::validar([
                'email' => ['required', 'email'],
                'senha' => ['required']
            ], $_POST);

            if ($validacao->naoPassou('login')) {
                header('Location: /login');
                exit;
            }

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $query = $database->query("SELECT * FROM usuarios WHERE email = :email", null, ['email' => $email]);
            $usuario = $query->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                
                header('Location: /');
                exit;
                
            } else {
                flash()->push('validacoes_login', ['E-mail ou senha incorretos.']);
                header('Location: /login');
                exit;
            }
        }
    }

    // Adicionado um exit preventivo para evitar que o código caia no 404 após processar o GET/POST do login
    exit; 
}


// 6. ROTA DA PÁGINA DE DETALHES DO JOGO
if (strpos($url, '/produto') === 0) {
    require_once __DIR__ . '/controllers/ProdutoController.php';

    $jogoId = $_GET['id'] ?? null;
    
    if (!$jogoId) {
        header('Location: /catalogo');
        exit;
    }

    $controller = new ProdutoController();
    $controller->detalhes($jogoId);
    exit;
}

// ROTA DE ERRO 404 (Sempre fora dos blocos if das rotas válidas)
http_response_code(404);
echo "Página não encontrada (404) - Verifique a URL.";
exit;