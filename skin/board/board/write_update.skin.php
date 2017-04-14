<?php
/**
 * Created by PhpStorm.
 * User: Pc
 * Date: 2017-04-13
 * Time: 오후 7:23
 */
if($bo_table=="review"){
    sql_query("UPDATE `gsw_product` set `hit`= `hit`+'{$wr_3}', `hit_id` = CONCAT(`hit_id`,',','{$wr_id}') WHERE `id` =".$wr_1." AND `hit_id` NOT LIKE '%{$wr_id}%'");

}