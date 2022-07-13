<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Cadastrar curso');

use \App\Entity\curso;
$obcurso = new curso;

//VALIDAÇÃO DO POST
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){

  $obcurso->titulo    = $_POST['titulo'];
  $obcurso->descricao = $_POST['descricao'];
  $obcurso->ativo     = $_POST['ativo'];
  $obcurso->cadastrar();

  header('location: index.php?status=success');
  exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';