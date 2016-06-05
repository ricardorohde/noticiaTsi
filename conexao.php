<?php


  class Conexao {
    //define o arquivo do banco
    const link = './_dados/dados.sql';
    //faz a conexão com o banco
    public function  conexaoSqlite() {
        //conexão com sqlite
        $dados = new SQLite3(self::link);
        return $dados;
    }
    function get_post_action($name){
        //formulario com varias opçoes
        $params = func_get_args();
        foreach ($params as $name) {
            if (isset($_POST[$name])) {
                return $name;
            }
        }
    }
    public function validaEmail($email){
            //verifica se e-mail esta no formato correto de escrita
        if (!ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})',$email)){
            return FALSE;
        }else{
            //Valida o dominio
            $dominio=explode('@',$email);
            if(!checkdnsrr($dominio[1],'A')){
                    return FALSE;
            }
            else{return true;} // Retorno true para indicar que o e-mail é valido
            }
    }

   
}







