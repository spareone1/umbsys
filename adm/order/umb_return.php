<?php
include_once ("../../lib/dbconfig.php");

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

$userid = $_GET['userid'];
$state = $_GET['state'];
$umname = $_GET['umname'];


//공백 확인
if($userid == "" || $state == "" || $umname == ""){
	echo "
	<script>
	alert('대여 정보가 정확하지 않습니다.');
	history.back();
	</script>
	";
	die;
}

if($state != 2){
	echo "
	<script>
	alert('대여 중이 아닙니다.');
	history.back();
	</script>
	";
	die;
}

//날짜 비교 (2일동안 반납을 하지 않을 시 지난 기간만큼 연체 처리)
//우산 대여 날짜 구하기
$sql = "SELECT lend_date FROM lend
	WHERE userid='$userid'
	;";
$time = mysqli_query($db, $sql);
$rs = mysqli_fetch_row($time);
$date = $rs[0];

//현재 날짜와 비교
$sql2 = "SELECT TO_DAYS(now()) - TO_DAYS('$date') AS CHA;";
$comp = mysqli_query($db, $sql2);
$res = mysqli_fetch_row($comp);
$date = $res[0];

if ($date < 3) {    //반납일이 3일 미만으로 차이나면 (2일 이하로 차이나면)
	//반납 처리 쿼리 (DB 삭제 구문)
	$lendsql = "DELETE FROM lend WHERE userid='$userid';";
	
	//우산 반납 처리 쿼리 (DB 업데이트 구문)
	$umbsql = "UPDATE umbrella SET
		um_state=0, um_userid=''
		WHERE um_name='$umname'
		;";
	
	//회원 상태 변경 쿼리
	$usersql = "UPDATE user SET
		state=0
		WHERE userid='$userid'
		;";

	mysqli_query($db, $lendsql);	
	mysqli_query($db, $umbsql);	
	mysqli_query($db, $usersql);	
	
	$_SESSION['state'] = 0;	
	
	echo "<script>
		alert ('반납이 완료되었습니다.');
		location.replace('./');
		</script> ";
} else {    //반납일이 3일 이상이면
	$date = $date-2;  //대여 가능한 기간 2일은 차감
	$cannotsql = "SELECT DATE_ADD(NOW(), INTERVAL '$date' DAY);";   //현재 시간에 연체 기간 날짜 추가
	$cannot = mysqli_query($db, $cannotsql);
	$resu = mysqli_fetch_row($cannot);
	$day = $resu[0];
	
	//반납 처리 쿼리 (DB 삭제 구문)
	$lendsql = "DELETE FROM lend WHERE userid='$userid';";
	
	//우산 반납 처리 쿼리 (DB 업데이트 구문)
	$umbsql = "UPDATE umbrella SET
		um_state=0, um_userid=''
		WHERE um_name='$umname'
		;";
	
	//회원 상태 변경 쿼리
	$usersql = "UPDATE user SET
		state=3, cannot_lend='$day'
		WHERE userid='$userid'
		;";

}
?>