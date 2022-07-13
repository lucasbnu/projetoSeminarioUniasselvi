<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Editar curso');

use \App\Entity\curso;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
  header('location: index.php?status=error');
  exit;
}

//CONSULTA A curso
$obcurso = curso::getcurso($_GET['id']);

//VALIDAÇÃO DA curso
if(!$obcurso instanceof curso){
  header('location: index.php?status=error');
  exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){

  $obcurso->titulo    = $_POST['titulo'];
  $obcurso->descricao = $_POST['descricao'];
  $obcurso->ativo     = $_POST['ativo'];
  $obcurso->atualizar();

  header('location: index.php?status=success');
  exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';