<?php

class CatalogoController {
    
    public function index() {
        // 1. Puxa a conexão global com o banco de dados
        global $database; 



        // ================= CONFIGURAÇÃO DA PAGINAÇÃO =================
        $itensPorPagina = 16; // Define quantos jogos quer exibir por tela

        // Pega a página atual pela URL. Se não existir, o padrão é a 1
        $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        if ($paginaAtual < 1) { 
            $paginaAtual = 1; 
        }

        // Calcula a partir de qual registro o banco vai começar a ler
        $offset = ($paginaAtual - 1) * $itensPorPagina;

        // Busca o total de jogos gerais e apenas os jogos da página atual
        $totalJogos = contarTotalJogos();
        $jogosDados = buscarJogosPaginados($itensPorPagina, $offset);

        // Calcula o total de páginas necessárias
        $totalPaginas = ceil($totalJogos / $itensPorPagina);


        // Transforma apenas os 8 jogos da página atual em objetos da classe Jogo
        $jogos = [];
        foreach ($jogosDados as $dados) {
            $jogo = new Jogo();
            $jogo->id = $dados['id'];
            $jogo->titulo = $dados['titulo'];
            $jogo->categoria = $dados['categoria'];
            $jogo->plataforma = $dados['plataforma'];
            $jogo->preco = $dados['preco'];
            $jogo->imagem = $dados['imagem'];
            
            $jogos[] = $jogo;
        }

        // Monta as listas únicas de categorias e plataformas para preencher os <select> do filtro
        $queryCategorias = $database->query("SELECT DISTINCT categoria FROM jogos ORDER BY categoria ASC");
        $categorias = $queryCategorias->fetchAll(PDO::FETCH_COLUMN);

        $queryPlataformas = $database->query("SELECT DISTINCT plataforma FROM jogos ORDER BY plataforma ASC");
        $plataformas = $queryPlataformas->fetchAll(PDO::FETCH_COLUMN);

        //  Envia todas as variáveis prontas para dentro do arquivo visual do catálogo
        require "view/catalogo.php";
    }
}