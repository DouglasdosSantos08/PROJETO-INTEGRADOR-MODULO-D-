<!DOCTYPE html>


<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetGaming Store - Promoções</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<!-- cor de fundo -->
<body class="bg-gray-950 text-gray-100 font-sans">

<!-- ==========================================================
     CABEÇALHO (HEADER)
     Exibe a logo da loja e o menu de navegação entre
     as páginas do sistema.
========================================================== -->
<header class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

        <!-- Logo da loja -->
        <a class="text-2xl font-bold text-indigo-400 cursor-pointer">
            Net<span class="text-white">Gaming</span> Store
        </a>

        <div class="flex items-center gap-6">

            <!-- Menu de navegação -->
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-400">
                <a href="/catalogo" class="text-gray-100 hover:text-white transition-colors">Catálogo</a>

                <!-- Página atual destacada -->
                <a href="/promocoes" class="text-indigo-400 font-semibold border-b-2 border-indigo-500">
                    Promoções
                </a>

                <a href="/suporte" class="text-gray-100 hover:text-white transition-colors">
                    Suporte
                </a>
            </nav>

        </div>
</header>

<!-- ==========================================================
     CONTEÚDO PRINCIPAL
     Apresenta o título da página e a lista de jogos
     disponíveis em promoção.
========================================================== -->
<main class="max-w-7xl mx-auto px-4 py-12">

    <!-- Título e descrição -->
    <h1 class="text-4xl font-extrabold mb-2 text-center">
        Ofertas <span class="text-indigo-500">Especiais</span>
    </h1>

    <p class="text-gray-400 text-center mb-10">
        Jogos exclusivos com descontos direto na sua conta.
        Aproveite por tempo limitado!
    </p>

    <!-- ======================================================
         GRADE DE PROMOÇÕES
         Organiza os jogos em formato de cards.
    ======================================================= -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">

        <!-- Verifica se existem promoções cadastradas -->
        <?php if (!empty($jogosPromo)): ?>

            <!-- Percorre todos os jogos em promoção -->
            <?php foreach ($jogosPromo as $jogo): ?>

                <!-- Card individual de um jogo -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden flex flex-col justify-between relative group">

                    <!-- Selo indicando a porcentagem de desconto -->
                    <div class="absolute top-3 right-3 bg-green-500 text-black text-xs font-black px-2.5 py-1 rounded-md shadow-md z-10">
                        -<?= htmlspecialchars($jogo['desconto_porcentagem']) ?>%
                    </div>

                    <!-- Imagem do jogo -->
                    <img
                        src="<?= htmlspecialchars($jogo['imagem']) ?>"
                        alt="<?= htmlspecialchars($jogo['titulo']) ?>"
                        class="w-full h-40 object-cover">

                    <div class="p-4 flex flex-col flex-1 justify-between">

                        <!-- Informações do jogo -->
                        <div>

                            <!-- Categoria e plataforma -->
                            <span class="text-xs font-semibold text-indigo-400 block mb-1">
                                <?= htmlspecialchars($jogo['categoria']) ?>
                                ·
                                <?= htmlspecialchars($jogo['plataforma']) ?>
                            </span>

                            <!-- Nome do jogo -->
                            <h3 class="font-bold text-lg mb-2 truncate">
                                <?= htmlspecialchars($jogo['titulo']) ?>
                            </h3>

                        </div>

                        <!-- Área de preços -->
                        <div class="mt-4">

                            <!-- Preço antigo -->
                            <p class="text-xs text-gray-500 line-through">
                                R$ <?= number_format($jogo['preco_antigo'], 2, ',', '.') ?>
                            </p>

                            <!-- Preço promocional -->
                            <p class="text-2xl font-black text-green-400">
                                R$ <?= number_format($jogo['preco_atual'], 2, ',', '.') ?>
                            </p>

                            <!-- Botão para visualizar o produto -->
                            <a
                                href="/produto?id=<?= $jogo['id'] ?>&promo=1"
                                class="mt-3 w-full py-2 block text-center rounded-lg text-sm font-semibold bg-indigo-600 hover:bg-indigo-500 text-white transition-colors">
                                Comprar chave
                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <!-- Mensagem exibida quando não há promoções -->
            <p class="text-gray-400 col-span-full text-center py-10">
                Nenhuma promoção ativa no momento. Volte mais tarde!
            </p>

        <?php endif; ?>

    </div>

</main>

<!-- ==========================================================
     RODAPÉ (FOOTER)
     Exibe informações sobre a aplicação e o ano atual.
========================================================== -->
<footer class="border-t border-gray-800 py-8 mt-12">

    <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500">
        © <?= date('Y') ?> NetGaming Store. Projeto acadêmico — versão de demonstração.
    </div>

</footer>

<!-- ==========================================================
     Responsável por abrir e fechar o menu suspenso
     do usuário, alternando a classe "hidden".
========================================================== -->
<script>
function toggleUserMenu() {
    const menu = document.getElementById('userDropdownMenu');
    menu.classList.toggle('hidden');
}
</script>

</body>
</html>