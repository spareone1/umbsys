<?php
include_once ("../pageconstant.php");
if (!defined('_UMBSYS_')) exit; //개별 페이지 접근을 차단합니다.
include_once ("../head.php");

//로그인 확인
session_start();
if(!isset($_SESSION['userid'])) {
	echo "<script>
		alert ('로그인 후 이용 가능합니다.');
		location.replace('../member/login/');
		</script>";
}

?>

<?php
include_once ("./order_form.php");
?>


<?php
include_once ("../tail.php");
?>