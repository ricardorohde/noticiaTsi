<?php

include './noticiaControlador.php';

//chama a classe noticia
$noticia = new Noticia();
//pega a função getNoticia
$getDados = $noticia->getNoticia();
//chama a função Portal
$res = new Portal();
//pega a função getPortal
$portal = $res->getPortal();

//verivica existe uma requeste
if($_SERVER['REQUEST_METHOD'] == 'POST'){  
    //chama a função get_post_action e passa os parametros.
    switch ($res->get_post_action('alterar', 'cadastrar', 'excluir','buscarNoticiaUnico')) {
        case 'cadastrar':
            //cadastra a noticia
           $noticia->cadastrarNoticia($_POST['idPortal'],$_POST['titulo'],$_POST['data'], $_POST['noticiaConteudo']);
            //salva a imagem
           $getUnico = $noticia->salvarImagen($_FILES['imagem']['tmp_name']);
           break;
        case 'alterar':
            //Alterar noticias
            $noticia->alterarNoticia($_POST['idNoticiaAlterar'], $_POST['idPortal'],$_POST['titulo'],$_POST['data'], $_POST['noticiaConteudo']);
            //comparar se a imagem ja existe e se existir substituir
            if($_FILES['imagem']){
                move_uploaded_file($_FILES['imagem']['tmp_name'] , Noticia::imagem.$_POST['idNoticiaAlterar'].'.jpg');
            }
            break;
        case 'buscarNoticiaUnico':
            //chama uma noticia unica
            $getUnico = $noticia->getUnicoNoticia($_POST['buscarNoticiaUnico']);
            $preenchercampo = $getUnico->fetchArray();
            break;
        case 'excluir':
            //excluir noticia
            $noticia->deletarNoticia($_POST['excluir']);
            break;
    }    
}
?>


<?php include './layout/head.php';?>
<form class="form-horizontal" method="post" action="" enctype='multipart/form-data'>
    
  <div class="form-group form-group-lg"> 
    <label class="col-sm-4 control-label" >Título</label>
    <div class="col-sm-4">
        <input class="form-control" type="text"  placeholder="Digite o título da noticia" required="" contenteditable="false" name="titulo" value="<?php echo @$preenchercampo['titulo'];?>">
    </div>
  </div>
    
  <div class="form-group form-group-lg"> 
    <label class="col-sm-4 control-label" for="formModel">Data</label>
    <div class="col-sm-4">
        <input class="form-control" type="date"  placeholder="Digite o site" required="" contenteditable="false" name="data" value="<?php echo @$preenchercampo['data'];?> ">
    </div>
  </div>
    
        
  <div class="form-group form-group-lg"> 
    <label class="col-sm-4 control-label" for="formMarca">Portal</label>
    <div class="col-sm-4">
        <select name="idPortal" class="form-control">
            <?php
                while($dados=$portal->fetchArray()):
            ?>        
                  <option value="<?php echo $dados['id_portal'];?>">
                       <?php echo $dados['nm_portal']; ?> 
                  </option>;
               
            <?php endwhile ?>
        </select>
    </div>
  </div>
  <div class="form-group form-group-lg"> 
    <label class="col-sm-4 control-label" >Foto</label>
    <div class="col-sm-4">
        <input type="file" name="imagem" data-icon="false">
    </div>
  </div>
    
  <div class="form-group form-group-lg"> 
    <label class="col-sm-4 control-label" for="formDefeito">Descrição</label>
    <div class="col-sm-4">
        <textarea rows="8"class="form-control"   placeholder="Digite a notícia" required="" contenteditable="false" name="noticiaConteudo"><?php echo @$preenchercampo['conteudo'];?> </textarea>
        <br> 
         <?php if(isset($preenchercampo)):?>    
            <input type="hidden" name="idNoticiaAlterar" value="<?php echo @$preenchercampo['id_noticia'];?>">
            <br><input name="alterar" type="submit" class="btn btn-lg btn-success" value="Alterar noticia">
        <?php else :?>
            <br><input name="cadastrar" type="submit" class="btn btn-lg btn-primary" value="Cadastrar noticia">
        <?php endif;?>
    </div>
  </div>
    
    
</form>


<div class="container" style="margin-bottom: 40px;" >
    <form class="form-horizontal" method="POST" action="">   
        <table  class="table  " >
            <thead>
                <td>Imagem</td>
                <td>Título</td>

                <td>Data</td>
                <td>Gravata</td>
                <td>Opções</td>
            </thead>
            <?php while($dados=@$getDados->fetchArray()): ?>              
            <tr>
                <td><img src="imagens/<?php echo $dados['id_noticia'];?>.jpg" height="200" width="200"></td>
                <td><?php echo $dados['titulo'];?></td>
                <td><?php echo $dados['data'];?></td>
                <td><?php echo $dados['gravata'];?>...</td>
                <td>
                    <button  value="<?php echo $dados['id_noticia'];?>" type="submit" name="excluir" class="glyphicon glyphicon-trash" style="color: red; margin-right: 10px;">Excluir</button>
                    <button  value="<?php echo $dados['id_noticia'];?>" type="submit" name="buscarNoticiaUnico" class="glyphicon glyphicon-pencil" style="color: blue; margin-right: 10px;">Alterar</button>
                </td>

            </tr>
            <?php endwhile ?>    
        </table>
    </form>
</div>

<?php include './layout/footer.php';?>

