-- Rodar dentro do banco "sistema_login" (o mesmo já usado pela tabela "usuarios")
-- Cria a tabela que guarda as mensagens enviadas pelo formulário de Suporte.

USE sistema_login;

CREATE TABLE IF NOT EXISTS mensagens_suporte (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nome       VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL,
    mensagem   TEXT         NOT NULL,
    criado_em  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
