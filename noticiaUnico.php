<?php 
//inclui os arquivos
include './layout/head.php';
include './noticiaControlador.php';
//instancia com a classe noticia
$noticia = new Noticia();
//verifica se existe request
if($_SERVER['REQUEST_METHOD'] =='POST'){   
    //chama a função cadastrarComentario
  $noticia->cadastrarComentario($_POST['idNoticia'],trim($_POST['email']),trim($_POST['comentario']));
    
}
//prepara os comentarios para visualização
$comentarios = $noticia->getComentario($_GET['id']);
$getDados = $noticia->getUnicoNoticia($_GET['id']);
$dados = $getDados->fetchArray();



?>


<div class="container" style="margin-bottom: 100px;">
    <div class="col-md-4"></div>
    <div class="col-md-4"> <img src="../imagens/<?php echo $dados['id_noticia'];?>.jpg" height="400" width="500"></div>
    <div class="col-md-12"><h1><?php echo $dados['titulo'];?></h1></div>
    <div class="col-md-12"><?php echo $dados['conteudo'];?></div>
</div>

<form  class="form-horizontal" method="POST" action="" style="margin-bottom: 100px;">
    
  <div class="form-group form-group-lg"> 
    <label class="col-sm-4 control-label" >E-mail</label>
    <div class="col-sm-4">
        <input class="form-control" type="text"  placeholder="Digite o e-mail" required="" contenteditable="false" name="email" >
    </div>
  </div>
    
  <div class="form-group form-group-lg"> 
    <label class="col-sm-4 control-label" >Comentário</label>
    <div class="col-sm-4">
        <input type="hidden" name="idNoticia" value="<?php echo $dados['id_noticia'];?>">
        <textarea rows="8"class="form-control"   placeholder="Digite seu comentario" required="" contenteditable="false" name="comentario">
           
        </textarea>
            <br><input name="cadastrar" type="submit" class="btn btn-lg btn-primary" value="Salvar Comentário">
    </div>
  </div>
</form> 

<div class="container" style="margin-bottom: 60px;">
    <table  class="table  " >
        <?php while($comentario = $comentarios->fetchArray()):?>
        <tr>
            <td><?php echo $comentario['email'];?></td>
            <td><?php echo $comentario['comentario'];?></td>
        </tr>
        <?php endwhile;?>
    </table>
</div>
<?php include './layout/footer.php';?>