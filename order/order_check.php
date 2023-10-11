<?php
include_once ("../lib/dbconfig.php");

session_start();
if(!isset($_SESSION['userid'])) {
	echo "<script>
		alert ('잘못된 접근입니다.');
		history.back();
		</script>";
	die;
}

$today = $_POST['today'];
$nowtime = $_POST['nowtime'];

$userid = $_SESSION['userid'];
$state = $_SESSION['state'];

//공백 확인
if($today == "" || $nowtime == "" ){
	echo "
	<script>
	alert('시간 정보가 정확하지 않습니다. 관리자에게 문의하세요.');
	history.back();
	</script>
	";
	die;
}



//중복요청 체크
$sql = "SELECT COUNT(*) FROM lend WHERE userid='$userid'; ";
$res = mysqli_query($db, $sql);
$rs = mysqli_fetch_row($res);
$already_registered_count = $rs[0];


if ($already_registered_count > 0) {
	echo "
	<script>
	alert('이미 대여 요청/연체 상태이거나 대여 중입니다.');
	history.back();
	</script>
	";
	die;
}

//패널티 여부 확인
if ($state > 2) {
	echo "
	<script>
	alert('연체 기간동안은 우산 요청이 블가능합니다.');
	history.back();
	</script>
	";
	die;
}

$sql = "INSERT INTO lend (
	userid,state,input_date
	) values (
	'$userid',1,now()
	);
	";
	
	
$usersql = "UPDATE user SET
	state=1
	WHERE userid='$userid'
	";	


mysqli_query($db, $sql);          //우산 요청 생성 쿼리 실행
mysqli_query($db, $usersql);          //회원 상태 변경 쿼리 실행

$_SESSION['state'] = 1;

$sql = "SELECT COUNT(*) FROM lend WHERE userid='$userid'; ";
$res = mysqli_query($db, $sql);
$rs = mysqli_fetch_row($res);
$already_registered_count = $rs[0];


if ($already_registered_count > 0) {
	echo "<script>
		alert ('요청이 완료되었습니다.');
		location.replace('../');
	</script> ";
} else {
	echo "<script>
		alert ('요청을 실패하였습니다.');
		history.back();
	</script> ";
}


?>