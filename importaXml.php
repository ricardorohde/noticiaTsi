<?php include './layout/head.php';?>
<!--<form method = "POST" action = "" enctype='multipart/form-data'>
						<input type="file" name="arquivoxml" data-icon="false">					
						<input type="submit" value="UPLOAD">
					</form>
-->
<?php 
//conexao no banco
	     function  conexaoSqlite() {
        //conexão com sqlite
        $dados = new SQLite3(self::link);
        return $dados;
   

$xml = simplexml_load_file('./teste.xml'); /* Lê o arquivo XML e recebe um objeto com as informações */
 var_dump($xml);
 /* Percorre o objeto e imprime na tela as informações de cada noticia */

foreach ($xml as $noticia){
	
	while($row = $dados->fetchArray()){
			
			$idPortal = $row['id_portal'];
			$titulo = $row['titulo'];
			$data = $row['data'];
			$conteudo = $row['conteudo'];
			$gravata = $row['gravata'];
    $dados = $this->conexaoSqlite();
       return $dados->exec("INSERT INTO`noticia` (titulo,id_portal,data,gravata,conteudo) VALUES ('$titulo', $idPortal, '$data', '$gravata','$conteudo')");
    }
}
 }
?>