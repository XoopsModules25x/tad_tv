<?php
include "../../../include/cp_header.php";

$of_sn = (int) (str_replace("node-_", "", $_POST['tad_tv_cate_parent_sn']));
$sn    = (int) (str_replace("node-_", "", $_POST['tad_tv_cate_sn']));

if ($of_sn == $sn) {
    die(_MA_TREETABLE_MOVE_ERROR1 . "(" . date("Y-m-d H:i:s") . ")");
} elseif (chk_cate_path($sn, $of_sn)) {
    die(_MA_TREETABLE_MOVE_ERROR2 . "(" . date("Y-m-d H:i:s") . ")");
}

$sql = "update " . $xoopsDB->prefix("tad_tv_cate") . " set `tad_tv_cate_parent_sn`='{$of_sn}' where `tad_tv_cate_sn`='{$sn}'";
$xoopsDB->queryF($sql) or die("Reset Fail! (" . date("Y-m-d H:i:s") . ")");

echo _MA_TREETABLE_MOVE_OK . " (" . date("Y-m-d H:i:s") . ")";

//檢查目的地編號是否在其子目錄下
function chk_cate_path($sn, $to_sn)
{
    global $xoopsDB;
    //抓出子目錄的編號
    $sql    = "select `tad_tv_cate_sn` from " . $xoopsDB->prefix("tad_tv_cate") . " where `tad_tv_cate_parent_sn`='{$sn}'";
    $result = $xoopsDB->query($sql) or web_error($sql);
    while (list($sub_sn) = $xoopsDB->fetchRow($result)) {
        if (chk_cate_path($sub_sn, $to_sn)) {
            return true;
        }
        if ($sub_sn == $to_sn) {
            return true;
        }
    }

    return false;
}
