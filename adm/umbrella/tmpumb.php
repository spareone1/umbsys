<?php
if (!defined('_UMBSYS_')) exit; //개별 페이지 접근을 차단합니다.

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

include_once ("../../lib/dbconfig.php");

$sql = "SELECT rfid FROM tmpumb";
$res = mysqli_query($db, $sql);
$rs = mysqli_fetch_row($res);
$tmpumb = $rs[0];

$sql2 = "SELECT * FROM umbrella WHERE rfid_id=$tmpumb;";
$res2 = mysqli_query($db, $sql2);
$rs2 = mysqli_fetch_row($res2);
$umb = $rs2[0];


?>

<!DOCTYPE html>
<html>
<head>
<title> RFID 태그 확인 :: 우산관리시스템 </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
  <link rel ="stylesheet" href="../../css/cssReset.css">
  <link rel ="stylesheet" href="css/add_form.css">
</head>
<body>

<center>
태그 ID : <?php echo $tmpumb; ?> <br>
등록 여부 : 
<?php if ($umb == 0) { ?>
등록안됨
<?php } else { ?>
등록됨
<?php } ?>


</center>
</body>
</html>