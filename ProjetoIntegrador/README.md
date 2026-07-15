# NetGaming Store 🎮

A **NetGaming Store** é uma plataforma web comercial desenvolvida como projeto acadêmico, voltada para o comércio de jogos eletrônicos e distribuição automatizada de licenças digitais. O sistema moderniza o atendimento de lojas de games locais, oferecendo aos jogadores um painel centralizado para gerenciar sua biblioteca de chaves de ativação, enquanto fornece ao lojista uma ferramenta integrada de controle e vendas.



## 👥 Integrantes do Grupo
* **Douglas dos Santos**
* **Felipe Machado Leandro**
* **Data de preenchimento:** 14/07/2026



## 🎯 Objetivo do Projeto

O objetivo principal é criar um ambiente digital onde o cliente possa adquirir chaves de ativação de jogos de forma rápida e segura. A plataforma resolve um problema comum de pequenos revendedores que gerenciam estoques e envios manualmente por redes sociais ou aplicativos de mensagem, o que costuma causar atrasos e erros operacionais. Com a NetGaming Store, a entrega da chave do jogo ocorre de maneira instantânea logo após a confirmação da compra via whatsApp.


## 💡 Justificativa

O mercado de jogos digitais cresce constantemente a cada ano, mas muitos pequenos revendedores ainda gerenciam seus estoques de códigos e realizam os envios aos clientes de forma totalmente manual, utilizando redes sociais ou aplicativos de mensagens. Esse processo manual atrasa as entregas e é altamente suscetível a erros humanos, como o envio de chaves duplicadas ou incorretas. 

A NetGaming Store soluciona diretamente essa dor do mercado ao automatizar a entrega instantânea das chaves logo após a confirmação do pagamento, eliminando a espera do cliente e reduzindo a carga de trabalho operacional do gestor da loja.


## 💻 Escopo e Funcionalidades

### O que o sistema possui (Requisitos Principais)
* **Sistema de Autenticação:** Login e cadastro de usuários com controle de níveis de acesso.
* **Catálogo de Jogos Interativo:** Navegação fluida com filtros rápidos por categoria e plataforma rodando em tempo real.

### O que o sistema não possui 
* **Pagamentos Reais:** Não há integração com APIs reais de pagamento (como Stripe, Mercado Pago ou PicPay). Todas as transações financeiras e fluxos de compra são apenas simulações internas.
* **Validação de Chaves:** Não há comunicação com servidores de plataformas externas (Steam, PlayStation Network ou Xbox Live) para resgatar os jogos de verdade. As chaves geradas são fictícias para fins de demonstração acadêmica.


### Frontend (Interface)
* **HTML5 & CSS3:** Estruturação semântica e layouts modernos.
* **Tailwind CSS:** Framework utilitário utilizado para criar toda a identidade visual escura, sombras e responsividade para dispositivos móveis sem pesar no carregamento e efeitos.
* **JavaScript (ES6):** filtragem instantânea do catálogo de jogos e o comportamento dos menus dinâmicos sem recarregar a página.

### Backend (Servidor e Lógica)
* **PHP:** Linguagem estruturada e orientada a objetos sob uma arquitetura MVC simplificada, garantindo rotas organizadas, controle de sessões seguro e separação de responsabilidades.

### Banco de Dados
* **MySQL:** Armazenamento persistente estruturado com conexões seguras via **PDO (PHP Data Objects)** para prevenir vulnerabilidades de segurança, divididos em tabelas para o controle de:
  * Usuários (Clientes e Administradores)
  * Jogos (Catálogo, preços e imagens)
  * Jogos Promoções (Catálogo, preços, imagens preço atual e antigo)
  * Mensagem de Suporte (nome, email e mensagem)

