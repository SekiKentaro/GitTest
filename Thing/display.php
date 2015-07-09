<?php
ini_set( 'display_errors', "1" );
require_once 'smarty/Smarty.class.php';
require "php/function.php";
$smarty = new Smarty();
$smarty->template_dir = 'templates/';
$smarty->compile_dir  = 'templates_c/';
$pdo_thing = new PDO("mysql:dbname=thing_mst_db; host=g-angle.sakura.ne.jp;", "thing_mst_db","0n353gnw");
$pdo_agenda = new PDO("mysql:dbname=agenda_mst_db; host=g-angle.sakura.ne.jp;", "agenda_mst_db","mdy22o6r");
$pdo_gms = new PDO("mysql:dbname=gms_mst_db; host=g-angle.sakura.ne.jp;", "gms_mst_db","3bceg66r");
/*--------------------------------Start--------------------------------*/

/*---------------------------------End---------------------------------*/
$smarty->display('display.html');
?>