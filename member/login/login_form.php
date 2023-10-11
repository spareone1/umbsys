<?php
if (!defined('_UMBSYS_')) exit; //개별 페이지 접근을 차단합니다.

session_start();
if(isset($_SESSION['userid'])) {
	echo "<script>
		alert ('잘못된 접근입니다.');
		history.back();
		</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
<title> 로그인 :: 우산관리시스템 </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
  <link rel ="stylesheet" href="../../css/cssReset.css">
  <link rel ="stylesheet" href="css/login_form.css">	
<script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../js/valueCheck_login.js"></script>
</head>
<body>

<div id="login">
	<section id="signin">
		<div id="singinCenter">
			<form id="signInForm" method="post" action="login_check.php">
				<div class="row">
					<div class="inputbox">
						<input type="text" name="userid" id="userid" placeholder="아이디">
					</div>
				</div>
				<div class="row">
					<div class="inputbox">
						<input type="password" name="userpw" id="userpw" placeholder="암호">
					</div>
				</div>
				<div class="row">
					<p id="valueError"></p>
				</div>
				<div class="row">
					<div class="submitbtn">
						<input type="submit" id="signInSubmit" value="로그인">
					</div>
					<input type="hidden" name="mode" value="save">
				</form>
			</form>
		</div>
	</section>
	
</div>
</body>
</html>