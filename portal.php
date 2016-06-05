<?php
//inclui arquivos
include './layout/head.php';
include './portalControlador.php';
//instancia classe portal
$res = new Portal();
$getDados = $res->getPortal();
//verifica se existe request
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //opções de cada botores 
    switch ($res->get_post_action('alterar', 'cadastrar', 'excluir','buscarPortalUnico')) {
        case 'cadastrar':
            //cadastra portal
            $res->cadastrarPortal($_POST['nome'], $_POST['site'], $_POST['email']);
            break;
        case 'alterar':
            //altera portal
            $res->alterarPortal($_POST['idPortalAlterar'],$_POST['nome'], $_POST['site'], $_POST['email']);
            break;
        case 'buscarPortalUnico':
            //busca unico portal
            $getUnico = $res->getUnicoPortal($_POST['buscarPortalUnico']);
            $preenchercampo = $getUnico->fetchArray();
            break;
        case 'excluir':
            //excluir portal
            $res->deletarPortal($_POST['excluir']);
            break;
    }
}
//
?>

<form  class="form-horizontal" method="POST" action="">
    
  <div class="form-group form-group-lg"> 
    <label class="col-sm-4 control-label" >Nome do portal</label>
    <div class="col-sm-4">
        <input class="form-control" type="text"  placeholder="Digite nome do portal" required="" contenteditable="false" name="nome" value="<?php echo @$preenchercampo['nm_portal'];?>">
    </div>
  </div>
    
  <div class="form-group form-group-lg"> 
    <label class="col-sm-4 control-label" >Site</label>
    <div class="col-sm-4">
        <input class="form-control" type="text" placeholder="Digite o site" required="" contenteditable="false" name="site" value="<?php echo @$preenchercampo['site'];?>">
    </div>
  </div>
    
  <div class="form-group form-group-lg"> 
    <label class="col-sm-4 control-label" >E-mail</label>
    <div class="col-sm-4">
        <input class="form-control" type="text"  placeholder="Digite o e-mail" required="" contenteditable="false" name="email" value="<?php echo @$preenchercampo['email'];?>">
        <?php if(isset($preenchercampo)):?>    
            <input type="hidden" name="idPortalAlterar" value="<?php echo @$preenchercampo['id_portal'];?>">
            <br><input name="alterar" type="submit" class="btn btn-lg btn-success" value="Alterar portal">
        <?php else :?>
            <br><input name="cadastrar" type="submit" class="btn btn-lg btn-primary" value="Cadastrar portal">
        <?php endif;?>
    
    </div>
  </div>
</form> 
<div class="container" >
    <form class="form-horizontal" method="POST" action="">   
        <table  class="table  " >
            <thead>
                <td>Portal</td>
                <td>Site</td>
                <td>Email</td>
                <td>Opções</td>
            </thead>
            <?php while($dados=$getDados->fetchArray()): ?>              
            <tr>
                <td><?php echo $dados['nm_portal'];?></td>
                <td><?php echo $dados['site'];?></td>
                <td><?php echo $dados['email'];?></td>
                <td>
                   <button  value="<?php echo $dados['id_portal'];?>" type="submit" name="excluir" class="glyphicon glyphicon-trash" style="color: red; margin-right: 10px;">Excluir</button>
                   <button  value="<?php echo $dados['id_portal'];?>" type="submit" name="buscarPortalUnico" class="glyphicon glyphicon-pencil" style="color: blue; margin-right: 10px;">Alterar</button>
                </td>

            </tr>
            <?php endwhile ?>    
        </table>

    </form>
</div>

<?php include './layout/footer.php';?>