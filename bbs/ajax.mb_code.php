<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/register.lib.php');

$mb_2 = trim($_POST['mb_2']);

if ($msg = exist_code($mb_2)) die($msg);
?>