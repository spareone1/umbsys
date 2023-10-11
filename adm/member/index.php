<?php
include_once ("../../pageconstant.php");
if (!defined('_UMBSYS_')) exit; //개별 페이지 접근을 차단합니다.
include_once ("../../head.php");

//관리자 외에는 접근 차단
session_start();

if($_SESSION['level'] < 8) {
	echo "
	<script>
	alert('잘못된 접근입니다.');
	history.back();
	</script>
	";
}

?>

<?php
include_once ("./list.php");
?>


<?php
include_once ("../../tail.php");
?>
