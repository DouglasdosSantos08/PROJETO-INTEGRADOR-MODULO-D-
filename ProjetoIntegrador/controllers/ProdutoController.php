<?php

class ProdutoController {
    
    public function detalhes($id = null) {
        
        // Pega o ID vindo da rota ou da URL ($_GET['id'])
        $idJogo = $id ?? ($_GET['id'] ?? null);
        
        if (!$idJogo) {
            header('Location: /catalogo');
            exit;
        }

        // Verifica se a URL contém o parâmetro que indica que é uma promoção
        $isPromo = isset($_GET['promo']) && $_GET['promo'] == '1';

        if ($isPromo) {
            // Se for promoção, busca na tabela jogos_promocoes
            $jogo = buscarJogoPromocaoPorId($idJogo);
        } else {
            // Se não for, busca na tabela padrão de jogos comuns
            $jogo = buscarJogoPorId($idJogo);
        }

        // Se não encontrar o jogo em nenhuma das tabelas, volta para o catálogo
        if (!$jogo) {
            header('Location: /catalogo');
            exit;
        }

        // Carrega a tela de visualização do produto
        require __DIR__ . '/../view/produto.php';
    }
}