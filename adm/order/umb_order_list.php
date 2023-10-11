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

$today = date("Y년 n월 j일 (요일 : D)");	
$nowtime = date("h시 i분 s초 (A)");


$sql = "SELECT * FROM umbrella WHERE um_state=0;";
$res = mysqli_query($db, $sql);

//공백 확인
if($userid == "" || $state == "" ){
	echo "
	<script>
	alert('회원 정보가 정확하지 않습니다.');
	history.back();
	</script>
	";
	die;
}

//상태 확인
if($state != 1){
	echo "
	<script>
	alert('대여 요청 상태가 아니거나 이미 대여했습니다.');
	history.back();
	</script>
	";
	die;
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>대여 가능 우산 목록 :: 우산관리시스템</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/list.css">
<meta charset="UTF-8">
</head>
<body>
<center>
대여 요청 회원 : <?php echo $userid; ?> <br>
현재 날짜 : <?php echo $today; ?> <br>
현재 시각 : <?php echo $nowtime; ?> <br>
</center>
<table>
	<thead>
		<tr>
		<th>우산번호</th><th>RFID UID</th><th>우산이름</th><th>우산종류</th><th>우산 대여상태</th><th>우산 파손신고 여부</th><th>승인</소>
		</tr>
	</thead>
	<? while ($row = mysqli_fetch_array($res)) { ?>
	<tbody>
		<tr>
			<td align="center"><?= $row[rowid] ?></td>
			<td align="center"><?= $row[rfid_id] ?></td>
			<td align="center"><?= $row[um_name] ?></td>
			<td align="center"><?= $row[um_type] ?></td>
			<td align="center">
					<? if($row[um_state] == 0) { ?>
						대여가능
					<? } else if($row[um_state] == 1) { ?>
						대여중
					<? } else if($row[um_state] == 2) { ?>
						<font color="red">파손</font>
					<? } ?>
			</td>
			<td align="center"><?= $row[um_dastate] ?></td>
			<td align="center">
				<form method="get" action="umb_order_check.php">
					<input type="hidden" name="um_name" value="<?php echo $row['um_name']; ?>" />
					<input type="hidden" name="userid" value="<?php echo $userid; ?>" />
					<input type="submit" id="delete" value="승인"/>
			</form>
			</td>
		</tr>
	</tbody>
	<? } ?>
</table>

</body>
</html>
<?
include_once ("../../tail.php");
?>