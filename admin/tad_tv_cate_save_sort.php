<?php
include '../../../include/cp_header.php';

$sn = (int)$_POST['tad_tv_cate_sn'];
$sort = (int)$_POST['sort'];
$sql = 'update `' . $xoopsDB->prefix('tad_tv_cate') . "` set `tad_tv_cate_sort`='{$sort}' where `tad_tv_cate_sn`='{$sn}'";
$xoopsDB->queryF($sql) or die('Save Sort Fail! (' . date('Y-m-d H:i:s') . ')');

echo 'Sort saved! (' . date('Y-m-d H:i:s') . ') ';
