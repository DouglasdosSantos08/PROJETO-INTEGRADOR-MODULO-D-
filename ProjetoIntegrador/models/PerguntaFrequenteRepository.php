<?php

require_once __DIR__ . '/PerguntaFrequente.php';

/* ==========================================================
   Responsável por armazenar e fornecer todas as perguntas
   frequentes utilizadas na página de suporte.
========================================================== */
class PerguntaFrequenteRepository
{
    /* ==========================================================
       Retorna um array contendo todas as perguntas frequentes
       cadastradas no sistema.
    ========================================================== */

    /** @return PerguntaFrequente[] */
    public static function listarTodas(): array
    {
        return [

    //  Perguntas de clientes 
            new PerguntaFrequente(
                'Como recebo minha chave de ativação após a compra?',
                'Assim que o pagamento for aprovado, o sistema libera a sua chave digital de forma segura. Nós enviamos o código de ativação diretamente para o seu WhatsApp cadastrado, pronto para ser resgatado e começar a jogar.'
            ),

        
            new PerguntaFrequente(
                'A chave funciona em qualquer região?',
                'Sim. Todas as chaves disponibilizadas na nossa loja são originais, oficiais e totalmente compatíveis com as contas brasileiras nas respectivas plataformas de ativação, como Steam, Epic Games, Xbox ou PlayStation.'
            ),

   
            new PerguntaFrequente(
                'Posso pedir reembolso depois de revelar a chave?',
                'Por se tratar de um produto digital de envio imediato, uma vez que a chave é visualizada ou enviada para o seu WhatsApp, não é possível realizar o reembolso, pois o código é exclusivo e de uso único.'
            ),

     
            new PerguntaFrequente(
                'Quais formas de pagamento são aceitas?',
                'Por ser uma versão de demonstração voltada para um projeto acadêmico, todas as compras e pagamentos dentro do site são apenas simulados. Nenhuma cobrança real ou transação financeira será realizada.'
            ),

          
            new PerguntaFrequente(
                'Onde encontro minhas compras anteriores?',
                'Você pode conferir todas as suas chaves e o histórico detalhado de pedidos diretamente na sua área de cliente no site, bastando estar logado na sua conta para acessar o seu painel.'
            ),
        ];
    }
}