<?php
if (!defined('_UMBSYS_')) exit; //개별 페이지 접근을 차단합니다.

include_once ("../../lib/dbconfig.php");

$sql = "SELECT * FROM user";
$res = mysqli_query($db, $sql);

?>

<!DOCTYPE HTML>
<html>
<head>
<title> 관리자화면 :: 우산관리시스템 </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/list.css">
</head>
<body>
<table>
	<thead>
		<tr>
		<th>회원번호</th><th>회원아이디</th><th>학년</th><th>반</th><th>번호</th><th>이름</th><th>권한</th><th>상태</th><th>삭제</소>
		</tr>
	</thead>
	<? while ($row = mysqli_fetch_array($res)) { ?>
	<tbody>
		<tr>
			<td align="center"><?= $row[rowid] ?></td>
			<td align="center"><?= $row[userid] ?></td>
			<td align="center"><?= $row[grade] ?></td>
			<td align="center"><?= $row[classes] ?></td>
			<td align="center"><?= $row[num] ?></td>
			<td align="center"><?= $row[name] ?></td>
			<td align="center"><?= $row[level] ?></td>
			<td align="center"><?= $row[state] ?></td>
			<td align="center">
				<form method="get" action="member_del.php">
					<input type="hidden" name="userid" value="<?php echo $row['userid']; ?>" />
					<input type="hidden" name="level" value="<?= $row[level] ?>" />
					<input type="submit" id="delete" value="삭제"/>
			</form>
			</td>
		</tr>
	</tbody>
	<? } ?>
</table>

</body>
</html>