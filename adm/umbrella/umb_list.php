<?php
if (!defined('_UMBSYS_')) exit; //개별 페이지 접근을 차단합니다.
include_once ("../../lib/dbconfig.php");

$sql = "SELECT * FROM umbrella";
$res = mysqli_query($db, $sql);

?>

<!DOCTYPE HTML>
<html>
<head>
<title> 우산 목록 :: 우산관리시스템 </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/list.css">
</head>
<body>
<table>
	<thead>
		<tr>
		<th>우산번호</th><th>RFID UID</th><th>우산이름</th><th>우산종류</th><th>우산 대여상태</th><th>우산 대여자ID</th><th>우산 파손신고 여부</th><th>삭제</소>
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
			<td align="center"><?= $row[um_userid] ?></td>
			<td align="center"><?= $row[um_dastate] ?></td>
			<td align="center">
				<form method="get" action="umb_delete.php">
					<input type="hidden" name="um_name" value="<?php echo $row['um_name']; ?>" />
					<input type="hidden" name="rfid" value="<?php echo $row['rfid_id']; ?>" />
					<input type="hidden" name="um_state" value="<?= $row[um_state] ?>" />
					<input type="submit" id="delete" value="삭제"/>
			</form>
			</td>
		</tr>
	</tbody>
	<? } ?>
</table>

</body>
</html>
<?
include_once ("../../../tail.php");
?>