<?php
include_once ("../../lib/dbconfig.php");

session_start();
if(isset($_SESSION['userid'])) {
	echo "<script>
		alert ('잘못된 접근입니다.');
		history.back();
		</script>";
}

$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$userpw_re = $_POST['userpw_re'];
$username = $_POST['username'];
$grade = $_POST['grade'];
$classes = $_POST['classes'];
$num = $_POST['num'];


//공백 확인
if($userid == "" || $userpw == "" || $userpw_re == "" || $username == "" || $grade == "" || $classes == "" || $num == ""){
	echo "
	<script>
	alert('회원 정보가 정확하지 않습니다. 공백 없이 입력하세요.');
	history.back();
	</script>
	";
	die;
}

//ID 영어, 숫자 확인
if(!ctype_alnum($userid)) {
	echo "
	<script>
	alert('ID는 영문, 숫자만 가능합니다.');
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



//ID중복 체크
$sql = "SELECT COUNT(*) FROM user WHERE userid='$userid' ";
$res = mysqli_query($db, $sql);
$rs = mysqli_fetch_row($res);
$already_registered_count = $rs[0];


if ($already_registered_count > 0) {
	echo "
	<script>
	alert('이미 등록된 아이디입니다. 다른 아이디를 입력하세요.');
	history.back();
	</script>
	";
	die;
}


$usersql = "INSERT INTO user (
	userid,pw,name,level,grade,classes,num,state
	) values (
	'$userid',MD5('$userpw'),'$username',2,'$grade','$classes','$num',0
	)
	";


mysqli_query($db, $usersql);          //회원 계정 생성 쿼리 실행

$sql = "SELECT COUNT(*) FROM user WHERE userid='$userid' ";
$res = mysqli_query($db, $sql);
$rs = mysqli_fetch_row($res);
$already_registered_count = $rs[0];


if ($already_registered_count > 0) {
	echo "<script>
		alert ('계정이 생성되었습니다.');
		location.replace('../login/');
	</script> ";
} else {
	echo "<script>
		alert ('계정 등록에 실패하였습니다.');
		history.back();
	</script> ";
}


?>