<?php
//include './layout/head.php';
session_start();
// Instanciamos/chamamos a classe
$rss = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss></rss>');
$rss->addAttribute('version', '2.0');
// Define a consulta
$db = new SQLite3('./_dados/dados.sql');
$results = $db->query('SELECT * FROM `noticia`');
//Variavel utilizada na url 
$id = '?id=';
//Percorre o array
while ($row = $results->fetchArray()) {
$channel = $rss->addChild('channel');
$channel->addChild('title', 'RSS NoticiaTsi');
//Define o link da chamada da noticia 
$channel->addChild('link', $_SESSION['link'].'noticiaUnico.php/');
$channel->addChild('description', 'RSS - Descrito');

 
foreach($row as $item){
    $item_channel = $channel->addChild('item'); 

    $item_channel->addChild('title', $row['titulo']);
	$item_channel->addChild('link', $id.$row['id_noticia']);
	$item_channel->addChild('description', $row['conteudo']);
	$item_channel->addChild('pubDate', date('r'));
}

}
header("content-type: application/rss+xml; charset=utf-8");
//Imprime o XML
echo $rss->asXML();
?>