<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <!-- Configurações da página -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte - NetGaming Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<!-- Fundo da Página -->
<body class="bg-gray-950 text-gray-100">

<!-- ==========================================================
     CABEÇALHO (HEADER)
     Exibe o nome da loja e o menu de navegação entre as páginas.
     O cabeçalho permanece fixo no topo durante a rolagem.
========================================================== -->
<header class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

        <!-- Logo da loja -->
        <a class="text-2xl font-bold text-indigo-400 cursor-pointer">
            Net<span class="text-white">Gaming</span> Store
        </a>

        <!-- Menu de navegação -->
        <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
            <a href="/catalogo" class="text-gray-100 hover:text-white transition-colors">
                Catálogo
            </a>

            <a href="/promocoes" class="text-gray-100 hover:text-white transition-colors">
                Promoções
            </a>

            <!-- Página atual destacada -->
            <a href="/suporte" class="text-indigo-300 font-semibold border-b-2 border-indigo-500">
                Suporte
            </a>
        </nav>
    </div>
</header>

<!-- ==========================================================
     SEÇÃO DE APRESENTAÇÃO
     Exibe o título da Central de Suporte e uma breve descrição
     sobre o objetivo da página.
========================================================== -->
<section class="max-w-4xl mx-auto px-4 py-12 text-center">

    <h1 class="text-4xl font-extrabold mb-4">
        Central de <span class="text-indigo-400">Suporte</span>
    </h1>

    <p class="text-gray-400 max-w-2xl mx-auto">
        Tire suas dúvidas sobre compras, chaves de ativação e entrega digital,
        ou entre em contato diretamente com nossa equipe.
    </p>

</section>

<!-- ==========================================================
     PERGUNTAS FREQUENTES 
     Lista todas as perguntas cadastradas no banco de dados.
     O foreach percorre cada registro e cria um card para cada
     pergunta e resposta.
========================================================== -->
<section class="max-w-4xl mx-auto px-4 pb-12">

    <h2 class="text-xl font-bold mb-4">Perguntas frequentes</h2>

    <div class="space-y-4">

        <!-- Percorre todas as perguntas vindas do Controller -->
        <?php foreach ($perguntas as $item): ?>

            <!-- Card da pergunta -->
            <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">

                <!-- Exibe a pergunta -->
                <h3 class="font-semibold text-indigo-400 mb-2">
                    <?= htmlspecialchars($item->pergunta) ?>
                </h3>

                <!-- Exibe a resposta -->
                <p class="text-sm text-gray-400">
                    <?= htmlspecialchars($item->resposta) ?>
                </p>

            </div>

        <?php endforeach; ?>

    </div>

</section>

<!-- ==========================================================
     FORMULÁRIO DE CONTATO
     Permite que o usuário envie uma mensagem para a equipe
     de suporte.
========================================================== -->
<section class="max-w-2xl mx-auto px-4 pb-16">

    <h2 class="text-xl font-bold mb-4">Ainda precisa de ajuda?</h2>

    <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">

        <!-- ==================================================
             MENSAGEM DE SUCESSO
             Exibida quando o formulário é enviado corretamente.
        =================================================== -->
        <?php if ($mensagem = flash()->get('sucesso_suporte')): ?>

            <div class="bg-green-600/20 text-green-300 text-sm rounded-lg p-3 mb-4 flex items-center gap-2">
                <span>✅</span>
                <?= htmlspecialchars($mensagem) ?>
            </div>

        <?php endif; ?>

        <!-- ==================================================
             MENSAGENS DE ERRO
             Exibe os erros de validação caso algum campo tenha
             sido preenchido incorretamente.
        =================================================== -->
        <?php if ($erros = flash()->get('validacoes_suporte')): ?>

            <div class="bg-red-600/20 text-red-300 text-sm rounded-lg p-3 mb-4">

                <!-- Percorre todos os erros encontrados -->
                <?php foreach ($erros as $erro): ?>

                    <div class="flex items-center gap-2">
                        <span>⚠️</span>
                        <?= htmlspecialchars($erro) ?>
                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

        <!-- ==================================================
             FORMULÁRIO
             Envia os dados para a rota /suporte utilizando
             o método POST.
        =================================================== -->
        <form method="POST" action="/suporte" class="space-y-4">

            <!-- Campo Nome -->
            <div>
                <label class="text-sm text-gray-400">Nome</label>

                <input
                    type="text"
                    name="nome"
                    required
                    class="w-full mt-1 bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Campo E-mail -->
            <div>
                <label class="text-sm text-gray-400">E-mail</label>

                <input
                    type="email"
                    name="email"
                    required
                    class="w-full mt-1 bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Campo Mensagem -->
            <div>
                <label class="text-sm text-gray-400">Mensagem</label>

                <textarea
                    name="mensagem"
                    rows="4"
                    required
                    class="w-full mt-1 bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>

            <!-- Botão para enviar o formulário -->
            <button
                type="submit"
                class="w-full py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 font-semibold">
                Enviar mensagem
            </button>

        </form>

    </div>

</section>

<!-- ==========================================================
     RODAPÉ (FOOTER)
     Exibe informações da aplicação e direitos autorais.
========================================================== -->
<footer class="border-t border-gray-800 py-8">

    <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500">
        © 2026 NetGaming Store. Projeto acadêmico — versão de demonstração.
    </div>

</footer>

</body>
</html>