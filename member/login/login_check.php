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

$sql = "SELECT * FROM user WHERE userid='$userid';";
$res = mysqli_query($db, $sql);
$rs = mysqli_fetch_array($res);

$level = $rs[level];
$name = $rs[name];
$grade = $rs[grade];
$classes = $rs[classes];
$num = $rs[num];
$state = $rs[state];

if ($rs[userid] == $userid && $userid != "") {
	if ($rs[pw] == md5($userpw)) {
		
		session_start();     //세션 시작
		
		//세션 설정
		$_SESSION['userid'] = $userid;
		$_SESSION['is_member'] = 1;
		$_SESSION['level'] = $level;
		$_SESSION['name'] = $name;
		$_SESSION['grade'] = $grade;
		$_SESSION['classes'] = $classes;
		$_SESSION['num'] = $num;
		$_SESSION['state'] = $state;
		
		echo "<script> location.replace('/'); </script>";
	} else {
		echo "<script>
			alert('암호가 올바르지 않습니다.');
			history.back();
			</script>
			";
	}
} else {
	echo "<script>
		alert('아이디가 올바르지 않습니다.');
		history.back();
		</script>
		";
}

?>