<?php
include_once ("../../lib/dbconfig.php");

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

$um_name = $_GET['um_name'];
$userid = $_GET['userid'];


//대여 처리 쿼리 (DB 업데이트 구문)
$lendsql = "UPDATE lend SET
	user_umname='$um_name', lend_date=now(), state=2
	WHERE userid='$userid'
	;";
	
//우산 대여 처리 쿼리 (DB 업데이트 구문)
$umbsql = "UPDATE umbrella SET
	um_state=1, um_userid='$userid'
	WHERE um_name='$um_name'
	;";
	
//회원 상태 변경 쿼리
$usersql = "UPDATE user SET
	state=2
	WHERE userid='$userid'
	;";

mysqli_query($db, $lendsql);	
mysqli_query($db, $umbsql);	
mysqli_query($db, $usersql);	
	
$_SESSION['state'] = 2;	
	
echo "<script>
	alert ('대여가 완료되었습니다.');
	location.replace('./');
	</script> ";


?>