<?php
include './conexao.php';


class Portal extends Conexao{   
    public function cadastrarPortal($nome,$site,$email){
       //cadastra portal
       $dados = $this->conexaoSqlite();
       return $dados->exec("INSERT INTO `portal` (`nm_portal`,site, `email`) VALUES ('$nome','$site', '$email')");
    }
    public function getPortal(){
        //retorna todos os portais
        $dados = $this->conexaoSqlite();
        return $dados->query("SELECT * FROM `portal`");
    }
    public function deletarPortal($id){
        //deleta portal
        $dados = $this->conexaoSqlite();
        $dados->exec("DELETE FROM `portal` WHERE `id_portal`= $id");
        //em teste !
        //$noticia = new Noticia();
        //$noticia->deletarNoticiaCascata($id);
   
    }
    public function alterarPortal($id,$nome,$site,$email){
        //altera portal
        $dados = $this->conexaoSqlite();
        $dados->exec("UPDATE `Portal` SET `nm_Portal`='$nome', site = '$site' , `email`='$email' WHERE `id_portal`= $id");
    }
    public function getUnicoPortal($id){
        //retorna portal unico
        $dados = $this->conexaoSqlite();
        return $dados->query("SELECT * FROM `portal`WHERE id_portal = $id");
    } 
}











