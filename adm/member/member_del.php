<?php

$userid = $_GET['userid'];
$level = $_GET['level'];

session_start();

//주소창에 입력해서 들어온 경우 접근 제한
if ($userid == "") {
	echo "<script>
	alert ('잘못된 접근입니다.');
	history.back();
	</script>
	";
	die;
}

if($_SESSION['level'] < 8) {
	echo "<script>
		alert ('잘못된 접근입니다.');
		history.back();
		</script>";
	die;
}

echo "<script>
	alert('".$userid." 회원을 삭제합니다.');
	</script>
	";
	

//최고관리자는 삭제 불가
if ($level > 9) {
	echo "<script>
	alert ('최고관리자 계정은 삭제가 불가능합니다.');
	history.back();
	</script>
	";
	die;
}

include_once ("../../lib/dbconfig.php");

$sql = "DELETE FROM user WHERE userid='$userid'";
mysqli_query($db, $sql);

//삭제되었는지 확인
$sql = "SELECT COUNT(*) FROM user WHERE userid='$userid' ";
$res = mysqli_query($db, $sql);
$rs = mysqli_fetch_row($res);
$already_registered_count = $rs[0];


if ($already_registered_count == 0) {
	echo "
	<script>
	alert('삭제되었습니다.');
	history.back();
	</script>
	";
	die;
} else {
	echo "
	<script>
	alert('삭제를 실패했습니다.');
	history.back();
	</script>
	";
	die;
}
?>