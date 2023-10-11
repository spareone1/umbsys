<?php
if (!defined('_UMBSYS_')) exit; //개별 페이지 접근을 차단합니다.

include_once ("../../lib/dbconfig.php");

$sql = "SELECT * FROM lend";
$res = mysqli_query($db, $sql);
?>

<!DOCTYPE HTML>
<html>
<head>
<title> 대여목록 :: 우산관리시스템 </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/list.css">
</head>
<body>
<table>
	<thead>
		<tr>
		<th>요청번호</th><th>회원아이디</th><th>대여한 우산이름</th><th>요청날짜</th><th>대여날짜</th><th>상태</th><th>대여승인</소><th>반납</소>
		</tr>
	</thead>
	<? while ($row = mysqli_fetch_array($res)) { ?>
	<tbody>
		<tr>
			<td align="center"><?= $row[rowid] ?></td>
			<td align="center"><?= $row[userid] ?></td>
			<td align="center"><?= $row[user_umname] ?></td>
			<td align="center"><?= $row[input_date] ?></td>
			<td align="center"><?= $row[lend_date] ?></td>
			<td align="center">
					<? if($row[state] == 0) { ?>
						대여가능
					<? } else if($row[state] == 1) { ?>
						대여요청
					<? } else if($row[state] == 2) { ?>
						대여중
					<? } else if($row[state] == 3) { ?>
						<font color="red">연체</font>
					<? } ?>
			</td>
			<td align="center">
				<form method="get" action="umb_order_list.php">
					<input type="hidden" name="userid" value="<?php echo $row['userid']; ?>" />
					<input type="hidden" name="state" value="<?php echo $row['state']; ?>" />
					<input type="submit" id="lend" value="승인"/>
				</form>
			</td>
			<td align="center">
				<form method="get" action="umb_return.php">
					<input type="hidden" name="userid" value="<?php echo $row['userid']; ?>" />
					<input type="hidden" name="state" value="<?php echo $row['state']; ?>" />
					<input type="hidden" name="umname" value="<?php echo $row['user_umname']; ?>" />
					<input type="submit" id="return" value="반납"/>
				</form>
			</td>
		</tr>
	</tbody>
	<? } ?>
</table>

</body>
</html>