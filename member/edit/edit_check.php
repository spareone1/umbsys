<?php
include_once ("../../lib/dbconfig.php");

session_start();
if(!isset($_SESSION['userid'])) {
	echo "<script>
		alert ('잘못된 접근입니다.');
		history.back();
		</script>";
}

$userid = $_SESSION['userid'];
$userpw = $_POST['userpw'];
$userpw_re = $_POST['userpw_re'];
$username = $_POST['username'];
$grade = $_POST['grade'];
$classes = $_POST['classes'];
$num = $_POST['num'];



//공백 확인
if($userpw == "" || $userpw_re == "" || $username == "" || $grade == "" || $classes == "" || $num == ""){
	echo "
	<script>
	alert('회원 정보가 정확하지 않습니다. 공백 없이 입력하세요.');
	history.back();
	</script>
	";
	die;
}


//비밀번호 8글자 이상
if(strlen($userpw) < 8){
	echo "
	<script>
	alert('비밀번호를 8자리 이상 입력하세요.');
	history.back();
	</script>
	";
	die;
}

//비밀번호 일치 확인
if($userpw !=  $userpw_re){
	echo "
	<script>
	alert('비밀번호를 다르게 입력했습니다.');
	history.back();
	</script>
	";
	die;
}


//숫자 확인
if(!is_numeric($grade)){
	echo "
	<script>
	alert('학년은 숫자만 입력하세요.');
	history.back();
	</script>
	";
	die;
}
if(!is_numeric($classes)){
	echo "
	<script>
	alert('반은 숫자만 입력하세요.');
	history.back();
	</script>
	";
	die;
}
if(!is_numeric($num)){
	echo "
	<script>
	alert('번호는 숫자만 입력하세요.');
	history.back();
	</script>
	";
	die;
}

//회원정보 수정 쿼리 (DB 업데이트 구문)
$usersql = "UPDATE user SET
	pw=MD5('$userpw'), name='$username', grade='$grade', classes='$classes', num='$num'
	WHERE userid='$userid'
	";


mysqli_query($db, $usersql);          //회원 정보 수정 쿼리 실행


//세션 재설정
$_SESSION['name'] = $username;
$_SESSION['grade'] = $grade;
$_SESSION['classes'] = $classes;
$_SESSION['num'] = $num;



echo "<script>
	alert ('완료되었습니다.');
	location.replace('/');
	</script> ";



?>