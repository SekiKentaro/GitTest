<?php
//CodeChange
function key_cast($key){
    $pdo_thing = new PDO("mysql:dbname=thing_mst_db; host=g-angle.sakura.ne.jp;", "thing_mst_db","0n353gnw");
    $st = $pdo_thing->query("select s_reg_staff from s_reg_mst where s_reg_key = '$key' && s_reg_dis = 1");
    while($row = $st->fetch()) $staffId = $row[0];
    if(!$staffId) header("location: login.php");
    return $staffId;
};

//CodeCreate
function random_chara(){
    $chr_num = 30;
    $rand_chr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    if(!empty($improper)){
        $fi = explode("/",$improper);
        $count1 = count($fi);
        for($i=0;$i<$count1;$i++){
            $rand_chr = str_replace($fi[$i],'',$rand_chr);
        }
    }
    $chr_len = mb_strlen($rand_chr);
    for($i=0;$i<$chr_num;$i++){
        $num = mt_rand(1,$chr_len) - 1;
        $chr = substr($rand_chr,$num,1);
        $ran_text .= $chr;
    }
    return $ran_text;
}

//TableMaxIdGet
function max_record($table_name){
    $pdo_thing = new PDO("mysql:dbname=thing_mst_db; host=g-angle.sakura.ne.jp;", "thing_mst_db","0n353gnw");
    if(strpos($table_name, '_mst')){
        $id_field = str_replace('_mst', '_id', $table_name);
    }elseif(strpos($table_name, '_tb')){
        $id_field = str_replace('_tb', '_id', $table_name);
    }
    $st = $pdo_thing->query("select max($id_field) from $table_name");
    while($row = $st->fetch()) $temp_id = $row[0];
    if(!$temp_id) $temp_id = 0;
    return $temp_id;
}
?>