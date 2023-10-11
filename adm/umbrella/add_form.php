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

$rfidid = $_GET['rfidid'];

?>

<!DOCTYPE html>
<html>
<head>
<title> 우산등록 :: 우산관리시스템 </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
  <link rel ="stylesheet" href="../../css/cssReset.css">
  <link rel ="stylesheet" href="css/add_form.css">	
</head>
<body>

<div id="add">
	<section id="signin">
		<div id="singinCenter">
			<form id="signInForm" method="get" action="add_check.php">
				<div class="row">
					<div class="inputbox">
						<input type="text" name="rfid" id="rfid" placeholder="RFID UID값" value="<?php echo $rfidid; ?>">
					</div>
				</div>
				<div class="row">
					<div class="inputbox">
						<input type="text" name="umbname" id="umbname" placeholder="우산 이름">
					</div>
				</div>
				<div class="row">
					<div class="inputbox">
						<input type="text" name="umbsort" id="umbsort" placeholder="우산 종류">
					</div>
				</div>
				<div class="row">
					<p id="valueError"></p>
				</div>
				<div class="row">
					<div class="submitbtn">
						<input type="submit" id="signInSubmit" value="등록">
					</div>
					<input type="hidden" name="mode" value="save">
				</form>
			</form>
		</div>
	</section>
	
</div>
</body>
</html>