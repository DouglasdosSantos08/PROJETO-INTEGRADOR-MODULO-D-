<!DOCTYPE html>


<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($jogo['titulo']) ?> - NetGaming Store</title>


    <link rel="stylesheet" href="/style.css">

</head>

<!-- Cor de fundo -->
<body class="body-store">

    <!-- ==========================================================
         CABEÇALHO (HEADER)
         Exibe a logo da loja e um botão para retornar
         ao catálogo de jogos.
    ========================================================== -->
    <header class="header-store">

        <div class="header-container">

            <!-- Logo da loja -->
            <a class="logo-store">
                Net<span>Gaming</span> Store
            </a>

            <!-- Botão para voltar ao catálogo -->
            <a href="/catalogo" class="btn-voltar">
                ← Voltar para Catálogo
            </a>

        </div>

    </header>

    <!-- ==========================================================
         CONTEÚDO PRINCIPAL
         Exibe todas as informações do jogo selecionado.
    ========================================================== -->
    <main class="main-product-container">

        <div class="product-card-detail">

            <!-- ==================================================
                 IMAGEM DO PRODUTO
                 Exibe a capa do jogo.
            =================================================== -->
            <div class="product-image-wrapper">

                <img
                    src="<?= htmlspecialchars($jogo['imagem']) ?>"
                    alt="<?= htmlspecialchars($jogo['titulo']) ?>"
                    class="product-img-large">

            </div>

            <!-- ==================================================
                 INFORMAÇÕES DO PRODUTO
                 Exibe categoria, plataforma, nome,
                 disponibilidade e descrição do jogo.
            =================================================== -->
            <div class="product-info-wrapper">

                <div class="product-header-info">

                    <!-- Categoria e plataforma -->
                    <span class="product-badge">
                        <?= htmlspecialchars($jogo['categoria']) ?>
                        ·
                        <?= htmlspecialchars($jogo['plataforma']) ?>
                    </span>

                    <!-- Nome do jogo -->
                    <h1 class="product-title">
                        <?= htmlspecialchars($jogo['titulo']) ?>
                    </h1>

                    <!-- Status de disponibilidade -->
                    <p class="product-status">
                        <span class="status-pulse-dot"></span>
                        Disponível para Entrega Imediata
                    </p>

                    <!-- Descrição do produto -->
                    <p class="product-description">
                        Adquira sua chave digital oficial para o jogo
                        <strong><?= htmlspecialchars($jogo['titulo']) ?></strong>.
                        O código de ativação será enviado para sua conta
                        logo após a aprovação do pagamento, via WhatsApp,
                        pronto para resgate na plataforma
                        <?= htmlspecialchars($jogo['plataforma']) ?>.
                    </p>

                </div>

                <!-- ==================================================
                     ÁREA DE PREÇOS
                     Exibe o preço normal ou promocional do jogo.
                =================================================== -->
                <div class="product-price-box">

                    <div class="price-label-group" style="display: flex; flex-direction: column; gap: 4px;">

                        <span class="price-text-sm">
                            Preço do produto:
                        </span>

                        <!-- Verifica se o jogo está em promoção -->
                        <?php if (isset($jogo['preco_atual'])): ?>

                            <!-- Preço original -->
                            <span class="price-text-old" style="text-decoration: line-through; color: #6b7280; font-size: 0.9rem;">
                                R$ <?= number_format($jogo['preco_antigo'], 2, ',', '.') ?>
                            </span>

                            <!-- Preço promocional -->
                            <span class="price-text-main" style="color: #22c55e; display: flex; align-items: center; gap: 8px;">

                                R$ <?= number_format($jogo['preco_atual'], 2, ',', '.') ?>

                                <!-- Selo de desconto -->
                                <span style="background-color: #22c55e; color: #020617; font-size: 0.75rem; font-weight: 900; padding: 2px 6px; border-radius: 6px;">
                                    -<?= htmlspecialchars($jogo['desconto_porcentagem']) ?>%
                                </span>

                            </span>

                        <?php else: ?>

                            <!-- Preço normal -->
                            <span class="price-text-main">
                                R$ <?= number_format($jogo['preco'] ?? 0, 2, ',', '.') ?>
                            </span>

                        <?php endif; ?>

                    </div>

                    <!-- ==================================================
                         BOTÃO DE COMPRA
                         Caso o usuário esteja logado,
                         poderá finalizar a compra.
                         Caso contrário, será direcionado
                         para a tela de login.
                    =================================================== -->
                    <?php if (isset($_SESSION['usuario_id'])): ?>

                        <a
                            href="whatsapp://send"
                            target="_blank"
                            class="btn-finalize-order"
                            style="display: block; text-align: center; text-decoration: none; box-sizing: border-box;">

                            Finalizar Compra

                        </a>

                    <?php else: ?>

                        <a
                            href="/login"
                            class="btn-finalize-order"
                            style="display: block; text-align: center; text-decoration: none; box-sizing: border-box; background-color: #374151;">

                            Faça Login para Comprar

                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </main>

    <!-- ==========================================================
         RODAPÉ (FOOTER)
         Exibe informações da aplicação.
    ========================================================== -->
    <footer class="footer-store">
        © 2026 NetGaming Store. Projeto acadêmico.
    </footer>

</body>
</html>