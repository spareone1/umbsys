<?php
if (!defined('_UMBSYS_')) exit; //개별 페이지 접근을 차단합니다.

include_once ("config.php");

session_start();

?>
<!doctype html>
<html>
 <head>
  <meta charset="UTF-8">
  <link rel ="stylesheet" href="/css/cssReset.css">
  <link rel ="stylesheet" href="/css/cssRes.css">
 </head>
 <body>
  <div id ="header">
  	<label for="toggle" onClick> 포항이동고등학교 </label>
	<input type="checkbox" id="toggle">

	<ul id = "nav">
		<h1 id="logo"> <a href="/">우산관리시스템</a> </h1>
		<nav>
			<ul>
				<?php if(isset($_SESSION['userid'])) { ?>
				<li> <?php echo $_SESSION['name']; ?>님 </li>
					<?php if($_SESSION['level'] >= 8) { ?>
						<li><a href ="/adm" id="menu"> 관리자화면 </a></li>
					<?php } else { ?>
						<li> <?php echo $_SESSION['grade']; ?>학년 <?php echo $_SESSION['classes']; ?>반 <?php echo $_SESSION['num']; ?>번</li>
					<?php } ?>
					
					
					<?php if($_SESSION['state'] == 0) { ?>
						<li><a href ="/order" id="menu"> 대여요청 </a></li>
					<?php } else if($_SESSION['state'] == 1) { ?>
						<li>대여요청중</li>
					<?php } else if($_SESSION['state'] == 2) { ?>
						<li>대여중</li>
					<?php } else if($_SESSION['state'] == 3) { ?>
						<li><font color="red">대여불가</font></li>
					<?php } ?>
					
					
				<li><a href ="/member/edit" id="menu"> 정보수정 </a></li>
				<li><a href ="/member/login/logout.php" id="menu"> 로그아웃 </a></li>
					
				<?php } else { ?>
				<li><a href ="/member/register" id="menu"> 회원가입 </a></li>
				<li><a href ="/member/login" id="menu"> 로그인 </a></li>
				<?php } ?>
			</ul>
		</nav>
	</ul>
  </div>
 </body>
</html>