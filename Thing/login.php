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
$i = 0;
$st = $pdo_gms->query("select staff_id,staff_name from staff_mst where staff_dis = 1 order by staff_id");
while($row = $st->fetch()){
    $staff[$i]['id'] = $row[0];
    $staff[$i]['name'] = $row[1];
    ++$i;
}

$smarty->assign("staff",$staff);
/*---------------------------------End---------------------------------*/
$smarty->display('login.html');
?>