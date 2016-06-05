<?php
$db = new SQLite3('./_dados/dados.sql');
$results = $db->query('SELECT * FROM `noticia`');
 
$xml = "<?xml version='1.0' encoding='UTF-8'?>";//cabeçalho do arquivo
       $xml .= "<Newsletter> n";
 
       while($row = $results->fetchArray()){
			
			$idPortal = $row['id_portal'];
			$titulo = $row['titulo'];
			$data = $row['data'];
			$conteudo = $row['conteudo'];
				
			
           $xml .= "<Noticias>";echo "</br>";
           $xml .= "<id_portal>$idPortal</id_portal>";echo "</br>";
           $xml .= "<titulo>$titulo</titulo>";echo "</br>";
           $xml .= "<data>$data</data>";echo "</br>";
		   $xml .= "<conteudo>$conteudo</conteudo>";echo "</br>";
           $xml .= "</Noticias>";
		   
       }
       $xml .= "</Newsletter>";
 
       $ponteiro = fopen('./teste.xml', 'w'); //cria um arquivo com o nome backup.xml
       fwrite($ponteiro, $xml); // salva conteúdo da variável $xml dentro do arquivo backup.xml
 
       $ponteiro = fclose($ponteiro); //fecha o arquivo
 
?>
