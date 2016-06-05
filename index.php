<?php 
include './layout/head.php';
include './noticiaControlador.php';

$noticia = new Noticia();
$getDados = $noticia->getNoticia();

if($_SERVER['REQUEST_METHOD'] =='POST'){
    //este post esta vindo do layout/header.php do formulario de pesquisa
    $getDados = $noticia->pesquisar($_POST['pesquisar']);
    
}   


?>


<div class="container" >
    <table  class="table  " >
        
        <?php while($dados = $getDados->fetchArray()):?>
        <tr>
            <td><img src="imagens/<?php echo $dados['id_noticia'];?>.jpg" height="200" width="200"></td> 
            <td><?php echo $dados['titulo'];?></td>
            <td><?php echo $dados['data'];?></td>
            <td><?php echo $dados['gravata'];?> ... <a href="noticiaUnico.php/?id=<?php echo $dados['id_noticia'];?>">Leia mais.</a>  </td>
        </tr>
        <?php endwhile;?>
    </table>
</div>

<?php include './layout/footer.php';?>