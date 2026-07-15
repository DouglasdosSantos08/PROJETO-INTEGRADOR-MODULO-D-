<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetGaming Store - Chaves de Jogos Digitais</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<!-- Cor do Site -->
<body class="bg-gray-950 text-gray-100">



<!-- Header da logo -->
<header class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="/catalogo" class="text-2xl font-bold text-indigo-400">
            Net<span class="text-white">Gaming</span> Store
        </a>
        

        <!-- Header das abas -->
        <div class="flex items-center gap-6">
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-400">
                <a href="/catalogo" class="text-gray-100 hover:text-white">Catálogo</a>
                <a href="/promocoes" class="text-gray-100 hover:text-white">Promoções</a>
                <a href="/suporte" class="text-gray-100 hover:text-white">Suporte</a>
            </nav>
            

            <!-- Usuario Logado -->
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <div class="relative inline-block text-left">
                    <button 
                        type="button" 
                        onclick="toggleUserMenu()"
                        class="flex items-center gap-2 bg-gray-800 py-1.5 px-4 rounded-full border border-gray-700 hover:bg-gray-700 hover:border-gray-600 transition-all focus:outline-none"
                    >
                        <svg class="w-5 h-5 text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-200 hidden sm:inline">
                            <?= htmlspecialchars($_SESSION['usuario_nome']) ?>
                        </span>
                    </button>

                    <!-- Deslogar o usuario -->
                    <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-900 border border-gray-800 rounded-xl shadow-2xl z-50 overflow-hidden">
                        <div class="px-4 py-3 bg-gray-900/50 border-b border-gray-800">
                            <p class="text-sm font-semibold text-white truncate"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></p>
                            <p class="text-xs text-gray-500 mt-0.5">Cliente NetGaming</p>
                        </div>
                        <div class="p-1">
                            <a href="/logout" class="flex items-center gap-2 w-full px-3 py-2 text-sm font-medium text-red-400 hover:bg-red-500/10 rounded-lg transition-colors group">
                                <svg class="w-4 h-4 text-red-400 transition-transform group-hover:translate-x-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>
                                Sair da Conta
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>

                <!-- Login entrar na conta -->
                <a href="/login" class="px-4 py-2 rounded-lg text-sm font-semibold bg-indigo-600 hover:bg-indigo-500 text-white transition-colors">
                    Entrar / Cadastrar
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- frases falando sobre o site -->
<section class="max-w-7xl mx-auto px-4 py-12 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
        Suas chaves de jogos, <span class="text-indigo-400">entrega instantânea</span>
    </h1>
    <p class="text-gray-400 max-w-2xl mx-auto">
        Compre licenças digitais com segurança e receba sua chave de ativação na hora, direto no seu painel de biblioteca.
    </p>
</section>


<!-- Pesquisa Filtro -->
<section class="max-w-7xl mx-auto px-4 mb-8">
    <div class="flex flex-wrap gap-4 items-center justify-between bg-gray-900 border border-gray-800 rounded-xl p-4">
        <input
            type="text"
            id="filtro-busca"
            placeholder="Buscar jogo..."
            class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-sm w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >

        <!-- Filtro Categoria de jogos -->
        <div class="flex flex-wrap gap-3">
            <select id="filtro-categoria" class="bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm">
                <option value="">Todas as categorias</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
                <?php endforeach; ?>
            </select>

            <select id="filtro-plataforma" class="bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm">
                <option value="">Todas as plataformas</option>
                <?php foreach ($plataformas as $plat): ?>
                    <option value="<?= htmlspecialchars($plat) ?>"><?= htmlspecialchars($plat) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</section>

<!-- Coisas do banco em grids de colunas, com o titulo, plataforma etc -->
<main class="max-w-7xl mx-auto px-4 pb-16">
    <div id="catalogo" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($jogos as $jogo): ?>
            <div
                class="game-card bg-gray-900 border border-gray-800 rounded-xl overflow-hidden flex flex-col"
                data-categoria="<?= htmlspecialchars($jogo->categoria) ?>"
                data-plataforma="<?= htmlspecialchars($jogo->plataforma) ?>"
                data-titulo="<?= htmlspecialchars(mb_strtolower($jogo->titulo)) ?>"
            >
                <img src="<?= htmlspecialchars($jogo->imagem) ?>" alt="<?= htmlspecialchars($jogo->titulo) ?>" class="w-full h-40 object-cover">

                <div class="p-4 flex flex-col flex-1">
                    <span class="text-xs text-indigo-400 font-semibold mb-1">
                        <?= htmlspecialchars($jogo->categoria) ?> · <?= htmlspecialchars($jogo->plataforma) ?>
                    </span>
                    <h3 class="font-bold text-lg mb-2"><?= htmlspecialchars($jogo->titulo) ?></h3>

                    <div class="mt-auto flex items-center justify-between">
                        <span class="text-xl font-bold text-white">
                            <?= $jogo->precoFormatado() ?>
                        </span>
                    </div>

                    <!-- Botão que quando clicado vai pro produto para compra da chave -->
                    <a 
                        href="/produto?id=<?= $jogo->id ?>" 
                        class="mt-3 w-full py-2 block text-center rounded-lg text-sm font-semibold bg-indigo-600 hover:bg-indigo-500 text-white transition-colors"
                    >
                        Comprar chave
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <!-- quando não encontrar nenhum jogo aparece a mensagem de nenhum jogo encontrado -->
    <p id="sem-resultados" class="hidden text-center text-gray-500 mt-10">
        Nenhum jogo encontrado com os filtros selecionados.
    </p>

    <!-- paginação de quando mudar a pagina de -1 pra ir pra pagina anterior e +1 pra pagina posterior  -->
    <div class="flex justify-center items-center gap-4 mt-10 pt-5 w-full">
        <?php if ($paginaAtual > 1): ?>
            <a href="/catalogo?pagina=<?= $paginaAtual - 1 ?>" class="bg-gray-900 border border-gray-800 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-indigo-600 hover:border-indigo-500 hover:shadow-lg hover:shadow-indigo-500/30">
                Anterior
            </a>
        <?php else: ?>
            <span class="bg-gray-900 border border-gray-800 text-gray-500 px-4 py-2 rounded-lg text-sm font-semibold opacity-40 cursor-not-allowed">
                Anterior
            </span>
        <?php endif; ?>

        <!-- Criando o laço de repitição pra indo pra frente -->
        <div class="flex gap-2">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <?php if ($i === $paginaAtual): ?>
                    <span class="bg-indigo-600 border border-indigo-500 text-white w-10 h-10 flex justify-center items-center rounded-lg font-semibold text-sm shadow-lg shadow-indigo-500/50">
                        <?= $i ?>
                    </span>
                <?php else: ?>
                    <a href="/catalogo?pagina=<?= $i ?>" class="bg-gray-900 border border-gray-800 text-gray-400 w-10 h-10 flex justify-center items-center rounded-lg font-semibold text-sm transition-all hover:text-white hover:border-gray-600">
                        <?= $i ?>
                    </a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>

        <!-- Botão pra ir pra ir pro posterior -->
        <?php if ($paginaAtual < $totalPaginas): ?>
            <a href="/catalogo?pagina=<?= $paginaAtual + 1 ?>" class="bg-gray-900 border border-gray-800 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-indigo-600 hover:border-indigo-500 hover:shadow-lg hover:shadow-indigo-500/30">
                Próximo
            </a>
        <?php else: ?>
            <span class="bg-gray-900 border border-gray-800 text-gray-500 px-4 py-2 rounded-lg text-sm font-semibold opacity-40 cursor-not-allowed">
                Próximo
            </span>
        <?php endif; ?>
    </div>
</main>


<!-- Mostrar do site os direitos autorais -->
<footer class="border-t border-gray-800 py-8">
    <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500">
        © 2026 NetGaming Store. Projeto acadêmico — versão de demonstração.
    </div>
</footer>
<script>



// SIstema de filtros e categoria funcional

// Aguarda o carregamento completo do HTML antes de executar o JavaScript
document.addEventListener('DOMContentLoaded', () => {

    // Pega o campo de pesquisa pelo ID definido no HTML
    const buscaInput = document.getElementById('filtro-busca');

    // Pega o seletor de categorias
    const categoriaSelect = document.getElementById('filtro-categoria');

    // Pega o seletor de plataformas
    const plataformaSelect = document.getElementById('filtro-plataforma');

    // Seleciona todos os cards de jogos que possuem a classe "game-card"
    const gameCards = document.querySelectorAll('.game-card');

    // Elemento que mostra uma mensagem quando nenhum jogo é encontrado
    const semResultados = document.getElementById('sem-resultados');


    // Função responsável por realizar os filtros dos jogos
    function filtrar() {

        // Pega o texto digitado na busca, transforma em letras minúsculas
        // e remove espaços desnecessários no começo e no final
        const busca = buscaInput.value.toLowerCase().trim();

        // Pega a categoria escolhida no filtro
        const categoria = categoriaSelect.value;

        // Pega a plataforma escolhida no filtro
        const plataforma = plataformaSelect.value;

        // Variável para contar quantos jogos ficaram visíveis
        let visiveis = 0;


        // Percorre todos os cards de jogos encontrados
        gameCards.forEach(card => {


            // Verifica se o título do jogo possui o texto pesquisado
            // O dataset pega informações dos atributos data-* do HTML
            const matchesBusca = !busca || card.dataset.titulo.includes(busca);


            // Verifica se a categoria do jogo corresponde à categoria selecionada
            // Caso nenhuma categoria seja escolhida, todos passam
            const matchesCategoria = !categoria || card.dataset.categoria === categoria;


            // Verifica se a plataforma do jogo corresponde à plataforma selecionada
            // Caso nenhuma plataforma seja escolhida, todos passam
            const matchesPlataforma = !plataforma || card.dataset.plataforma === plataforma;



            // Caso o jogo corresponda a todos os filtros
            if (matchesBusca && matchesCategoria && matchesPlataforma) {

                // Remove a classe "hidden", fazendo o jogo aparecer
                card.classList.remove('hidden');

                // Aumenta o contador de jogos encontrados
                visiveis++;

            } else {

                // Adiciona a classe "hidden", escondendo o jogo
                card.classList.add('hidden');
            }
        });


        // Mostra ou esconde a mensagem "sem resultados"
        // Se existir pelo menos um jogo, fica escondida
        // Caso contrário, aparece
        semResultados.classList.toggle('hidden', visiveis > 0);
    }



    // Quando o usuário digitar na barra de pesquisa,
    // chama a função de filtro automaticamente
    buscaInput.addEventListener('input', filtrar);


    // Quando mudar a categoria selecionada,
    // executa novamente o filtro
    categoriaSelect.addEventListener('change', filtrar);


    // Quando mudar a plataforma selecionada,
    // executa novamente o filtro
    plataformaSelect.addEventListener('change', filtrar);

});



// Função responsável por abrir e fechar o menu do usuário
function toggleUserMenu() {

    // Busca o menu pelo ID
    const menu = document.getElementById('userDropdownMenu');

    // Alterna a classe "hidden"
    // Se estiver escondido, mostra
    // Se estiver aparecendo, esconde
    menu.classList.toggle('hidden');
}



// Detecta qualquer clique feito na página
window.addEventListener('click', (e) => {


    // Pega o menu do usuário
    const menu = document.getElementById('userDropdownMenu');


    // Verifica se o clique foi no botão que abre o menu
    const btn = e.target.closest('button[onclick="toggleUserMenu()"]');



    // Verifica se:
    // 1 - O menu existe
    // 2 - O menu está aberto
    // 3 - O clique não foi dentro do menu
    // 4 - O clique não foi no botão do menu
    if (
        menu &&
        !menu.classList.contains('hidden') &&
        !e.target.closest('#userDropdownMenu') &&
        !btn
    ) {

        // Fecha o menu adicionando a classe hidden
        menu.classList.add('hidden');
    }

});

</script>