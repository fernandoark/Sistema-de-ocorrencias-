<?php

/**
 * Enter description here ...
 * @author fernando.martins
 *
 */
class Alerta
{
    const CLASSE_CSS = 'alert';
    const LISTA_VAZIA = 'Sua lista está vazia.';

    private $arrayMsgOk;
    private $arrayMsgErro;

    function __construct($msg = '')
    {
        $this->arrayMsgErro = array();
        $this->arrayMsgOk = array();

        // Mensagens de Ok
        $this->arrayMsgOk['OPERACAO_SUCESSO'] = "Opera&ccedil;&atilde;o realizada com sucesso!";
        $this->arrayMsgOk['SENHA_SUCESSO'] = "Senha atualizada com sucesso!";
        $this->arrayMsgOk['EMAIL_REDEFINIR_SENHA'] = 'E-mail enviado!<br/>Por favor, confira seu e-mail e leia as instruções para redefinir sua senha.';
		$this->arrayMsgOk['EMAIL_ENVIADO'] = 'E-mail enviado com sucesso!';
		$this->arrayMsgOk['CADASTRO_COD_SUCESSO'] = 'Cadastro realizado com sucesso! Faça login e comece sua escalada.';
		$this->arrayMsgOk['SENHA_RECUPERADA'] = "A senha foi enviada para seu e-mail!";
		
        // Mensagens de Erro
		$this->arrayMsgErro['EMAIL_NAO_ENVIADO'] = 'Ocorreu um erro no envio do e-mail, por favor entre em contato por telefone!';
        $this->arrayMsgErro['OPERACAO_ERRO'] = "Erro ao executar a operacao!";
        $this->arrayMsgErro['ERRO_DELETAR_MODULO'] = "Este módulo está sendo utilizado por um ou mais cursos!";
        $this->arrayMsgErro['EXCLUIR_REGISTRO_REL'] = 'Não foi possível excluir este registro, porque ele está sendo utilizado!';
        $this->arrayMsgErro['REL_EXISTENTE'] = "Este(s) relacionamento(s) já existe(m) no banco de dados!";
        $this->arrayMsgErro['LOGIN_INCORRETO'] = "Dados incorretos!";
        $this->arrayMsgErro['EMAIL_NAO_ENCONTRADO'] = 'O e-mail passado não foi encontrado no banco de dados!';
        $this->arrayMsgErro['LOGIN_EXISTENTE'] = "O login utilizado no cadastrado já existe. Por favor utilize outro!";
        $this->arrayMsgErro['CODIGO_INVALIDO'] = "Código de acesso incorreto!";
        $this->arrayMsgErro['CODIGO_USADO'] = "Este código já foi utilizado!";
        $this->arrayMsgErro['EMAIL_NAO_ENCONTRADO'] = "O e-mail ou login não foi encontrado!";
        $this->arrayMsgErro['EQUIP_JA_ADQUIRIDO'] = "Você já possui este equipamento em sua mochila!";
        $this->arrayMsgErro['SALDO_INSUFICIENTE'] = "Você não tem saldo suficiente para comprar este equipamento!";
        $this->arrayMsgErro['QTD_SUP_ULTRAPASSADA'] = "A quantidade de suprimentos que você está tentando comprar, não cabe em sua mochila!";
        
        $this->obterAlerta($msg);
    }

    /**
     * Monta a div html com o texto e a classe css
     * @param unknown_type $msg
     * @param unknown_type $cor
     * @return string
     */
    private function desenharHtml($texto, $tipo)
    {
        return '<div class="' . self::CLASSE_CSS . ' ' . $tipo . '" align="center">' . $texto . '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    }

    /**
     * Enter description here ...
     * @param unknown_type $msg
     */
    private function obterAlerta($msg)
    {
        $arrayErroKeys = array_keys($this->arrayMsgErro);
        $arrayOkKeys = array_keys($this->arrayMsgOk);

        if (in_array($msg, $arrayErroKeys))
        {
            echo $this->desenharHtml($this->arrayMsgErro[$msg], 'alert-error');
        } 
        else if (in_array($msg, $arrayOkKeys))
        {
            echo $this->desenharHtml($this->arrayMsgOk[$msg], 'alert-success');
        } 
        else
        {
            echo $this->desenharHtml(' -- ', '#666');
            
        }
    }

}
?>

