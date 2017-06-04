<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_tv_adm_groupperm.tpl";
include_once "header.php";
include_once "../function.php";
include_once XOOPS_ROOT_PATH . "/Frameworks/art/functions.php";
include_once XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php";
include_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';

//取得本模組編號
$module_id = $xoopsModule->getVar('mid');

//頁面標題
$perm_page_title = _MA_TADTV_PERM_TITLE;

//取得分類編號及標題
$sql    = "select `tad_tv_cate_sn`, `tad_tv_cate_title` from " . $xoopsDB->prefix("tad_tv_cate");
$result = $xoopsDB->query($sql) or web_error($sql);
while (list($tad_tv_cate_sn, $tad_tv_cate_title) = $xoopsDB->fetchRow($result)) {
    $item_list[$tad_tv_cate_sn] = $tad_tv_cate_title;
}

//觀看權限
$formi = new XoopsGroupPermForm($perm_page_title, $module_id, 'perm_view', _MA_TADTV_PERM_VIEW);
foreach ($item_list as $item_id => $item_name) {
    $formi->addItem($item_id, $item_name);
}
$perm_view_form = $formi->render();
$xoopsTpl->assign('perm_view_form', $perm_view_form);

//產生頁籤語法
if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/easy_responsive_tabs.php")) {
    redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
}
include_once XOOPS_ROOT_PATH . "/modules/tadtools/easy_responsive_tabs.php";
$responsive_tabs = new easy_responsive_tabs('#groupPermTab', 'default');
$responsive_tabs->rander();

include_once 'footer.php';