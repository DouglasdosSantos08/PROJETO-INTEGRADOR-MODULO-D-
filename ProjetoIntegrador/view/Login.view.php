<link rel="stylesheet" href="style.css">

<!-- ==========================================================
     BARRA SUPERIOR (NAV)
     Exibe o botão para voltar ao catálogo e o título
     da página de autenticação.
========================================================== -->
<nav class="aba-superior">
    <a href="/" class="botao-voltar">
        ⬅ Voltar para Catálogo
    </a>


    <!-- Título da página -->
    <div class="logo">
        Faça seu cadastro
    </div>

</nav>

<!-- ==========================================================
     Agrupa os dois cartões: Login e Registro.
========================================================== -->
<div class="auth-container">

    <!-- ======================================================
         CARD DE LOGIN
         Permite que usuários já cadastrados façam login.
    ======================================================= -->
    <div class="auth-card">

        <h1 class="auth-title">Login</h1>

        <!-- ==================================================
             MENSAGENS DE ERRO DO LOGIN
             Exibe os erros de validação caso o login
             seja preenchido incorretamente.
        =================================================== -->
        <?php if ($validacao = flash()->get('validacoes_login')): ?>

            <div class="erros-container">

                <?php foreach ($validacao as $v): ?>

                    <div class="erro-mensagem">
                        <span class="erro-icone">⚠️</span>
                        <?= $v ?>
                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

        <!-- ==================================================
             FORMULÁRIO DE LOGIN
             Envia os dados do usuário para autenticação.
        =================================================== -->
        <form class="auth-form" method="POST" action="/login">

            <!-- Campo de e-mail -->
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input">
            </div>

            <!-- Campo de senha -->
            <div class="form-group">
                <label class="form-label label-indent">Senha</label>
                <input type="password" name="senha" class="form-input">
            </div>

            <!-- Botão de login -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Logar
                </button>
            </div>

        </form>

    </div>

    <!-- ======================================================
         CARD DE REGISTRO
         Permite que novos usuários criem uma conta.
    ======================================================= -->
    <div class="auth-card">

        <h1 class="auth-title">Registro</h1>

        <!-- ==================================================
             MENSAGEM DE SUCESSO
             Exibida quando o cadastro é realizado
             com sucesso.
        =================================================== -->
        <?php if (isset($_REQUEST['mensagem'])): ?>

            <div class="sucesso-container">

                <div class="sucesso-mensagem">
                    <span class="sucesso-icone">✅</span>
                    <?= $_REQUEST['mensagem']; ?>
                </div>

            </div>

        <?php endif; ?>

        <!-- ==================================================
             MENSAGENS DE ERRO DO CADASTRO
             Exibe possíveis erros encontrados
             durante o registro.
        =================================================== -->
        <?php if ($validacoes_cadastro = flash()->get('validacoes')): ?>

            <div class="erros-container">

                <?php foreach ($validacoes_cadastro as $v): ?>

                    <div class="erro-mensagem">
                        <span class="erro-icone">⚠️</span>
                        <?= $v ?>
                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

        <!-- ==================================================
             FORMULÁRIO DE CADASTRO
             Envia os dados do novo usuário para registro.
        =================================================== -->
        <form action="/login" method="POST" class="auth-form">

            <!-- Campo Nome -->
            <div class="form-group">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-input">
            </div>

            <!-- Campo E-mail -->
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-input">
            </div>

            <!-- Confirmação de E-mail -->
            <div class="form-group">
                <label class="form-label">
                    Confirme seu email
                </label>
                <input type="text" name="email_confirmacao" class="form-input">
            </div>

            <!-- Campo Senha -->
            <div class="form-group">
                <label class="form-label label-indent">Senha</label>
                <input type="password" name="senha" class="form-input">
            </div>

            <!-- Botões do formulário -->
            <div class="form-actions row-actions">

                <!-- Envia o cadastro -->
                <button type="submit" class="btn btn-primary">
                    Registrar
                </button>

                <!-- Limpa os campos do formulário -->
                <button type="reset" class="btn btn-secondary">
                    Cancelar
                </button>

            </div>

        </form>

    </div>

</div>