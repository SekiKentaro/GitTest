<?php
ini_set( 'display_errors', true);
require_once 'smarty/Smarty.class.php';
require "php/function.php";
$smarty = new Smarty();
$smarty->template_dir = 'templates/';
$smarty->compile_dir  = 'templates_c/';
$pdo_thing = new PDO("mysql:dbname=thing_mst_db; host=g-angle.sakura.ne.jp;", "thing_mst_db","0n353gnw");
$pdo_agenda = new PDO("mysql:dbname=agenda_mst_db; host=g-angle.sakura.ne.jp;", "agenda_mst_db","mdy22o6r");
$pdo_gms = new PDO("mysql:dbname=gms_mst_db; host=g-angle.sakura.ne.jp;", "gms_mst_db","3bceg66r");
/*--------------------------------Start--------------------------------*/
$loginStaffId = key_cast($_COOKIE['staffKey']);

$i = 0;
$st = $pdo_thing->query("select color_id,color_name,color_code from color_mst where color_dis = 1");
while($row = $st->fetch()){
    $color[$i]['id'] = $row[0];
    $color[$i]['name'] = $row[1];
    $color[$i]['code'] = $row[2];
    ++$i;
}
$i=0;
$st = $pdo_thing->query("select lank_id,lank_name from lank_mst where lank_dis = 1 order by lank_id");
while($row = $st->fetch()){
    $lank[$i]['id'] = $row[0];
    $lank[$i]['name'] = $row[1];
    ++$i;
}
$i=0;
$st = $pdo_thing->query("select class_id,class_name,class_color from class_tb where class_staff = '$loginStaffId' && class_dis = 1");
while($row = $st->fetch()){
    $class[$i]['id'] = $row[0];
    $class[$i]['name'] = $row[1];
    $class[$i]['color'] = $row[2];
    ++$i;
}
$i=0;
$st = $pdo_gms->query("select staff_id,staff_name from staff_mst where staff_dis = 1 order by staff_id");
while($row = $st->fetch()){
    $staff[$i]['id'] = $row[0];
    $staff[$i]['name'] = $row[1];
    ++$i;
}
$i=0;
$st = $pdo_thing->query("select group_id,group_name from group_tb where group_staff = '$loginStaffId' && group_dis = 1");
while($row = $st->fetch()){
    $group[$i]['id'] = $row[0];
    $group[$i]['name'] = $row[1];
    $st2 = $pdo_thing->query("select g_staff_staff from g_staff_tb where g_staff_group = '$row[0]' && g_staff_dis = 1");
    while($row2 = $st2->fetch()){
        $staffText .= $row2[0]."/";
    }
    $group[$i]['staff'] = substr($staffText,0,strlen($staffText)-1);
    ++$i;
}



$smarty->assign("color",$color);
$smarty->assign("class",$class);
$smarty->assign("lank",$lank);
$smarty->assign("staff",$staff);
$smarty->assign("group",$group);
/*---------------------------------End---------------------------------*/
$smarty->display('index.html');
?>