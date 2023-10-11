<?php
if (!defined('_UMBSYS_')) exit; //개별 페이지 접근을 차단합니다.

session_start();
if(!isset($_SESSION['userid'])) {
	echo "<script>
		alert ('로그인 후 이용 가능합니다.');
		location.replace('../member/login/');
		history.back();
		</script>";
}


$today = date("Y년 n월 j일 (요일 : D)");	
$nowtime = date("h시 i분 s초 (A)");

?>

<!DOCTYPE html>
<html>
<head>
<title> 대여요청 :: 우산관리시스템 </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
  <link rel ="stylesheet" href="../../css/cssReset.css">
  <link rel ="stylesheet" href="css/register_form.css">	
</head>
<body>

<div id="register">
	<section id="signup">
		<div id="singupCenter">
			<form id="signUpForm" method="post" action="order_check.php">
				<div class="row">
					<div class="inputbox">
						<input type="text" name="today" id="today" placeholder="현재 날짜" value="<?php echo $today; ?>" readonly/>
					</div>
				</div>
				<div class="row">
					<div class="inputbox">
						<input type="text" name="nowtime" id="nowtime" placeholder="현재 시간" value="<?php echo $nowtime; ?>" readonly/>
					</div>
				</div>
				<div class="row">
					<p id="valueError"></p>
				</div>
				<div class="row">
					<div class="submitbtn">
						<input type="submit" id="signUpSubmit" value="대여 요청" />
					</div>
					<input type="hidden" name="mode" value="save" />
				</form>
			</form>
		</div>
	</section>
	
</div>
</body>
</html>