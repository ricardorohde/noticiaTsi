<?php
//inclui arquivo
include './portalControlador.php';

class Noticia extends Portal{
    //declara o endereço pasta imagem
    const imagem = 'imagens/';
    //declara a extensão padão das imagens do sistema
    const formatoImagem = '.jpg';

    public function geradorGravata($str){
        //gera a gravata da notícia
        $gravata = substr(trim($str),0,200);
        return $gravata;
    }
    public function cadastrarNoticia($idPortal,$titulo,$data,$conteudo){
       //cadastra as noticias
        $gravata = $this->geradorGravata($conteudo);
       $dados = $this->conexaoSqlite();
       return $dados->exec("INSERT INTO`noticia` (titulo,id_portal,data,gravata,conteudo) VALUES ('$titulo', $idPortal, '$data', '$gravata','$conteudo')");
    }
    public function getNoticia(){
        //retorna as noticias em forma decrescente
        $dados = $this->conexaoSqlite();
        return $dados->query("SELECT * FROM noticia ORDER BY id_noticia DESC");
    }
    public function deletarNoticia($id){
        //deleta a noticia e os seus comentarios
        $dados = $this->conexaoSqlite();
        $this->deletarImagem($id);
        $dados->exec("DELETE FROM `comentarios` WHERE `id_noticia`= $id");
        $dados->exec("DELETE FROM `noticia` WHERE `id_noticia`= $id");
    }
    public function alterarNoticia($idNoticia,$idPortal,$titulo,$data,$conteudo){
        //altera as noticias
        $gravata = $this->geradorGravata($conteudo);
        $dados = $this->conexaoSqlite();
        $dados->exec("UPDATE `noticia` SET `titulo`='$titulo', id_portal = $idPortal , `data`='$data', gravata = '$gravata', conteudo = '$conteudo' WHERE `id_noticia`= $idNoticia");
    }
    public function getUnicoNoticia($id){
        //retorna uma determinada noticia
        $dados = $this->conexaoSqlite();
        return $dados->query("SELECT * FROM `noticia`WHERE id_noticia = $id");
    } 
    public function salvarImagen($img){
        //salva a imagem
        $nomeImagem = $this->montarNomeImg();
        $idNoticia = $this->getUltimaIdnoticia();
        $idNoticia = $idNoticia['id_noticia'];
        //função que salva imagem em uma pasta
        move_uploaded_file($img , $nomeImagem);
        $dados = $this->conexaoSqlite();
        $dados->exec("INSERT INTO`imagem`(id_noticia,imagem,destaque) VALUES ($idNoticia, $idNoticia, 'true')");
    }
    public function montarNomeImg(){
        //renomeia a imagem de acordo com o a regra
        $idNoticia = $this->getUltimaIdnoticia();
        //regra de nome
        $nomeMontado = self::imagem.$idNoticia['id_noticia'].self::formatoImagem;
        return $nomeMontado;
    }
    public function getUltimaIdnoticia(){
        //pega a ultima noticia do banco
         $query = $this->conexaoSqlite();
         $dados = $query->query("SELECT * FROM `noticia`ORDER BY id_noticia DESC LIMIT 1");
         $dados  = $dados->fetchArray();
         return $dados;
    }
    private function deletarImagem($id){
        //deleta  a imagem
        $dados = $this->conexaoSqlite();
        $dados->exec("DELETE FROM `imagem` WHERE `id_noticia`= $id");
        //função para deletar a imagem
        unlink(self::imagem.$id.self::formatoImagem);
    }
    public function cadastrarComentario($idNoticia,$email,$comentario){
        //cadastra o comentario da noticia
        //validação do email
        if($this->validaEmail($email)){
             $dados = $this->conexaoSqlite();
             $dados->exec("INSERT INTO comentarios (id_noticia,email,comentario) VALUES ($idNoticia, '$email', '$comentario')");
        }  
    }
    public function getComentario($id) {
        //pega o comentario.
        $dados = $this->conexaoSqlite();
        return $dados->query("SELECT * FROM comentarios WHERE id_noticia = '$id' ORDER BY id_comentario DESC");
         
    }
    public function pesquisar($str){
        //função de pesquisa.
        $dados = $this->conexaoSqlite();
        return $dados->query("select * from noticia where titulo like '%$str%' or conteudo like '%$str%' ORDER BY id_noticia DESC");
    }
    public function  deletarNoticiaCascata($id){
        //EM TESTE, deleção em cascata...
        $dados = $this->conexaoSqlite();
        $getdados = $dados->exec("SELECT FROM `noticia` WHERE `id_portal`= $id");
        while ($dado = $getdados->fetchArray()){
            $this->deletarNoticia($dado['id_noticia']);
        }
    }
}

