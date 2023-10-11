<?php

include_once ("{$_SERVER['DOCUMENT_ROOT']}/config.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/pageconstant.php");
if (!defined('_UMBSYS_')) exit; //개별 페이지 접근을 차단합니다.

include_once ("{$_SERVER['DOCUMENT_ROOT']}/head.php");

include_once ("edit_form.php");

include_once ("{$_SERVER['DOCUMENT_ROOT']}/tail.php");
?>

<style>
<?php
include_once (UMBSYS_CSS_DIR."/css/cssReset.css");
include_once (UMBSYS_CSS_DIR."/css/cssRes.css");
?>
</style>