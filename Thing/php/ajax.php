<?php
require "function.php";
$pdo_thing = new PDO("mysql:dbname=thing_mst_db; host=g-angle.sakura.ne.jp;", "thing_mst_db","0n353gnw");
$pdo_agenda = new PDO("mysql:dbname=agenda_mst_db; host=g-angle.sakura.ne.jp;", "agenda_mst_db","mdy22o6r");
$pdo_gms = new PDO("mysql:dbname=gms_mst_db; host=g-angle.sakura.ne.jp;", "gms_mst_db","3bceg66r");
$loginStaffId = key_cast($_COOKIE['staffKey']);
/*--------------------------------Start--------------------------------*/
$loginTemp = $_POST['login'];
if($loginTemp){
    $id = array_shift(explode(',',$loginTemp));
    $pass = array_pop(explode(',',$loginTemp));
    $st = $pdo_gms->query("select staff_id from staff_mst where staff_id = '$id' && staff_pass = BINARY '$pass' && staff_dis = 1");
    while($row = $st->fetch()) $staffId = $row[0];
    if($staffId){
        $st = $pdo_thing->query("select s_reg_key from s_reg_mst where s_reg_staff = '$staffId' && s_reg_dis = 1");
        while($row = $st->fetch()) $loginKey = $row[0];
        if(!$loginKey){
            $loginKey = random_chara();
            $today = date('Y-m-d H:i:s');
            $tmp_id = max_record('s_reg_mst') + 1;
            $st = $pdo_thing->prepare("insert into s_reg_mst VALUES(?,?,?,?,?,?)");
            $st->execute(array($tmp_id, $staffId, $loginKey, $today, $today, '1'));
        }
    }else{
        $loginKey = "No";
    }
    header('Content-Type:application/json');
    echo json_encode($loginKey);
}
//タスク登録
$taskRegistration = $_POST['taskRegistration'];
if($taskRegistration){
    $today = date('Y-m-d H:i:s');
    $tempArray = explode(',',$taskRegistration);
    $name = $tempArray[0];
    $date = str_replace('-','/',$tempArray[1]);
    $date = str_replace('　',' ',$date);
    $date = str_replace('：',':',$date);
    $date = date('Y-m-d H:i:s',strtotime($date));
    $class = $tempArray[2];
    $lank = $tempArray[3];
    $detail = $tempArray[4];

    $tmp_id = max_record('task_tb') + 1;
    $st = $pdo_thing->prepare("insert into task_tb VALUES(?,?,?,?,?,?,?,?,?,?,?)");
    $st->execute(array($tmp_id, $name, $date, $loginStaffId, $class, $lank, $detail, 0, $today, $today, '1'));
    $data = array('id'=>$tmp_id, 'name'=>$name, 'date'=>$date, 'class'=>$class, 'lank'=>$lank, 'detail'=>$detail);
    header('Content-Type:application/json');
    echo json_encode($data);
}
//クラス登録
$classRegistration = $_POST['classRegistration'];
if($classRegistration){
    $today = date('Y-m-d H:i:s');
    $name = array_shift(explode(',',$classRegistration));
    $color = array_pop(explode(',',$classRegistration));
    $tmp_id = max_record('class_tb') + 1;
    $st = $pdo_thing->prepare("insert into class_tb VALUES(?,?,?,?,?,?,?)");
    $st->execute(array($tmp_id, $name, $color, $loginStaffId, $today, $today, '1'));
    $data = array('id'=>$tmp_id, 'name'=>$name, 'color'=>$color);
    header('Content-Type:application/json');
    echo json_encode($data);
}
//グループ登録
$groupRegistration = $_POST['groupRegistration'];
if($groupRegistration){
    $today = date('Y-m-d H:i:s');
    $name = array_shift(explode(',',$groupRegistration));
    $staffText = substr(array_pop(explode(',',$groupRegistration)),0,strlen(array_pop(explode(',',$groupRegistration)))-1);
    $staff = explode('/',$staffText);
    $group_id = max_record('group_tb') + 1;
    $st = $pdo_thing->prepare("insert into group_tb VALUES(?,?,?,?,?,?)");
    $st->execute(array($group_id, $name, $loginStaffId, $today, $today, '1'));
    $staffCt = count($staff);
    $tmp_id = max_record('g_staff_tb');
    for($i=0;$i<$staffCt;$i++){
        ++$tmp_id;
        $st = $pdo_thing->prepare("insert into g_staff_tb VALUES(?,?,?,?,?,?)");
        $st->execute(array($tmp_id, $group_id, $staff[$i], $today, $today, '1'));
    }
    $data = array('id'=>$group_id, 'name'=>$name, 'staff'=>$staffText);
    header('Content-Type:application/json');
    echo json_encode($data);
}

/*---------------------------------End---------------------------------*/
?>