<?php
session_start();
const PADRAO_URL = 'http://localhost/noticiaTsi/'; 
$_SESSION['link'] = PADRAO_URL;
?> 
<html>
    <head>
        <title>index</title>
        
        <meta charset="utf-8">
        
        <link href="<?PHP echo PADRAO_URL;?>layout/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?PHP echo PADRAO_URL;?>layout/bootstrap/css/bootstrap-theme.css.map" rel="stylesheet" type="text/css">
        <link href="<?PHP echo PADRAO_URL;?>layout/bootstrap/css/padrao.css" rel="stylesheet" type="text/css">
        
        
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a class="navbar-brand" href="/noticiaTsi/"><strong>NoticiasTsi</strong></a></li>
                  <li class="active"><a href="/noticiaTsi/">Home</a></li>
                  <li><a href="<?PHP echo PADRAO_URL;?>portal.php">Cadastrar Portal</a></li>
                  <li><a href="<?PHP echo PADRAO_URL;?>noticia.php">Cadastrar Noticia</a></li>
                  <li><a href="<?PHP echo PADRAO_URL;?>rss.php">RSS</a></li>
				  <li><a href="<?PHP echo PADRAO_URL;?>importaXml.php">Importar XML</a></li>
				  <li><a href="<?PHP echo PADRAO_URL;?>exportaXml.php">Exportar XML</a></li>
                  <li>
                      <form action="<?PHP echo PADRAO_URL;?>index.php" method="post">
                          <input type="text" name="pesquisar">
                          <input type="submit" value="pesquisar">
                      </form>
                  </li>
                </ul>
            </div>
        </nav>