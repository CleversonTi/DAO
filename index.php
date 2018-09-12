<?php

require_once("config.php");
/*
	$sql = new Sql();
	$usuarios = $sql->select("SELECT * FROM tb_Usuario");
	echo json_encode($usuarios);
*/
	//Carrega um usuario
/*	$root = new Usuario();
	$root->loadById(3);
*/
//	echo $root;
	echo "<hr>"."<br>";
	//$lista = Usuario::getList();
	//echo json_encode($lista);
	
/*
	/$lista = Usuario::search("F");
	echo json_encode($lista);
 */
/*CRIA LOGIN
 $usuario = new Usuario();
$usuario->login("Tiago", "123456");
echo $usuario;
*/
/*
$aluno = new Usuario("Lucas", "Arrombado");

$aluno->insert();

echo $aluno;
*/
/* Update de Aluno
$aluno = new Usuario();
$aluno->loadById(8);
$aluno->update("Adenilson", "BichonaLoa");
echo "<pre>";
echo $aluno;
echo "<pre>";
*/
$aluno = new Usuario();
$aluno->loadById(1);
$aluno->delete();
echo "<pre>";
echo $aluno;
echo "<pre>";

