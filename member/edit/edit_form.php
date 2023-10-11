<?php
if (!defined('_UMBSYS_')) exit; //개별 페이지 접근을 차단합니다.

session_start();
if(!isset($_SESSION['userid'])) {
	echo "<script>
		alert ('잘못된 접근입니다.');
		history.back();
		</script>";
}
	
?>

<!DOCTYPE html>
<html>
<head>
<title> 회원정보수정 :: 우산관리시스템 </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
  <link rel ="stylesheet" href="../../css/cssReset.css">
  <link rel ="stylesheet" href="css/edit_form.css">	
<script type="text/javascript" src="../../js/jquery-3.3.1.min.js?ver=1"></script>
</head>
<body>

<div id="register">
	<section id="signup">
		<div id="singupCenter">
			<form id="signUpForm" method="post" action="edit_check.php">
				<div class="row">
					<div class="inputbox">
						<input type="text" name="userid" id="userid" placeholder="아이디" value="<?php echo $_SESSION['userid']; ?>" disabled/>
					</div>
				</div>
				<div class="row">
					<div class="inputbox">
						<input type="password" name="userpw" id="userpw" placeholder="암호" />
					</div>
				</div>
				<div class="row">
					<div class="inputbox">
						<input type="password" name="userpw_re" id="userpw_re" placeholder="암호 재입력" />
					</div>
				</div>
				<div class="row">
					<div class="inputbox">
						<input type="text" name="username" id="username" placeholder="이름" value="<?php echo $_SESSION['name']; ?>"/>
					</div>
				</div>
				<div class="row">
					<span>학번</span>
					<div class="inputbox2">
						<input type="text" name="grade" id="grade" placeholder="학년" value="<?php echo $_SESSION['grade']; ?>"/>
					</div>
					<div class="inputbox2">
						<input type="text" name="classes" id="classes" placeholder="반" value="<?php echo $_SESSION['classes']; ?>"/>
					</div>
					<div class="inputbox2">
						<input type="text" name="num" id="num" placeholder="번호" value="<?php echo $_SESSION['num']; ?>"/>
					</div>
				</div>
				<div class="row">
					<p id="valueError"></p>
				</div>
				<div class="row">
					<div class="submitbtn">
						<input type="submit" id="signUpSubmit" value="정보수정" />
					</div>
					<input type="hidden" name="mode" value="save" />
				</form>
			</form>
		</div>
	</section>
	
</div>
</body>
</html>