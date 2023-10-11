<?php
include_once ("lib/dbconfig.php");

session_start();

$userid = $_SESSION['userid']

//연체 기간인 경우
if($_SESSION['state'] == 3) {
	//연체 종료일 날짜 구하기
	$sql = "SELECT cannot_lend FROM user
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
	
		if ($date < 1) {    //연체 해제 날짜가 현재 날짜와 일치하거나 넘으면
		//회원 상태 변경 쿼리
		$usersql = "UPDATE user SET
			state=0
			WHERE userid='$userid'
			;";
			
		mysqli_query($db, $usersql);	
	
		$_SESSION['state'] = 0;	
	}
}
?>