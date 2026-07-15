<?php

class Validacao
{
    public $validacoes = [];

    // Método estático que inicia a checagem das regras do formulário
    public static function validar($regras, $dados)
    {
        $validacao = new self;

        foreach ($regras as $campo => $regrasDoCampo) {
            foreach ($regrasDoCampo as $regra) {
                $valorDocampo = $dados[$campo] ?? '';

                if ($regra == 'confirmed') {
                    $confirmacao = $dados["{$campo}_confirmacao"] ?? '';
                    $validacao->$regra($campo, $valorDocampo, $confirmacao);
                } else if (str_contains($regra, ':')) {
                    $temp = explode(':', $regra);
                    $regra = $temp[0];
                    $regraAr = $temp[1];

                    $validacao->$regra($campo, $regraAr, $valorDocampo);
                } else {
                    $validacao->$regra($campo, $valorDocampo);
                }
            }
        }

        return $validacao;
    }

    // Regra: Campo Obrigatório
    private function required($campo, $valor)
    {
        if (strlen(trim($valor)) == 0) {
            $this->validacoes[] = "O campo $campo é obrigatório!";
        }
    }

    // Regra: Formato de E-mail Válido
    private function email($campo, $valor)
    {
        if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $this->validacoes[] = "O campo $campo deve ser um e-mail válido!";
        }
    }

    // Regra: Confirmação de campos iguais (ex: email e email_confirmacao)
    private function confirmed($campo, $valor, $confirmed)
    {
        if ($valor != $confirmed) {
            $this->validacoes[] = "A confirmação do campo $campo está diferente!";
        }
    }

    // Regra: Mínimo de caracteres
    private function min($campo, $regraAr, $valor)
    {
        if (strlen($valor) < $regraAr) {
            $this->validacoes[] = "A senha tem que ter no mínimo $regraAr caracteres!";
        }
    }

    // Regra: Máximo de caracteres
    private function max($campo, $regraAr, $valor)
    {
        if (strlen($valor) > $regraAr) {
            $this->validacoes[] = "A $campo tem que ter no máximo $regraAr caracteres!";
        }
    }

    // Regra: Exigir caractere especial
    private function strong($campo, $valor)
    {
        if (!strpbrk($valor, '!@#$%^*&()?/')) {
            $this->validacoes[] = "O campo $campo tem que ter pelo menos um caractere especial!";
        }
    }

    // Regra: Exigir letra maiúscula
    private function uppercase($campo, $valor)
    {
        if (!preg_match('/[A-Z]/', $valor)) {
            $this->validacoes[] = "O campo $campo deve conter pelo menos uma letra maiúscula!";
        }
    }

    // Regra: Verificar se o registro já existe na tabela do banco de dados
    private function unique($campo, $tabela, $valor)
    {
        if (strlen($valor) == 0) {
            return;
        }

        global $database;

        $resultado = $database->query(
            "select * from $tabela where $campo = :valor",
            null,
            ['valor' => $valor]
        )->fetch();

        if ($resultado) {
            $this->validacoes[] = "O $campo já existe cadastrado!";
        }
    }

    // Verifica se alguma regra falhou e joga os erros na Session Flash
    public function naoPassou($nomeCustomizado = null)
    {
        $chave = 'validacoes';

        if ($nomeCustomizado) {
            $chave .= '_' . $nomeCustomizado;
        }

        flash()->push($chave, $this->validacoes);

        return sizeof($this->validacoes) > 0;
    }
}