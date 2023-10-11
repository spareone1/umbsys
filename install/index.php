<?php
$db_file_exist = file_exists('../lib/dbconfig.php');
 if ($db_file_exist) {
    echo "<script>
	alert('이미 설치되었습니다.');
	history.back();
	</script>
	";
	die;
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="ko" xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<title> UMSYS 설치 </title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" /> 

</head>

<body>

<? include_once ("../config.php"); ?>

<center>
<form method=post action="install.php">
<h3> UMSYS를 설치합니다. </h3>
<h3> DATABASE 정보 입력 후 확인을 눌러주세요. </h3> <br>
호스트 : <input type="text" name="host"> <br><br>
사용자 : <input type="text" name="user"> <br><br>
암호 : <input type="text" name="pw"> <br><br>
DB명 : <input type="text" name="dbname"> <br><br>
<h4> 최고관리자 계정을 생성합니다. </h4>
<h4> 정확히 내용을 기입해주세요. </h4> <br>
ID : <input type="text" name="admid"> <br><br>
암호 : <input type="text" name="admpw"> <br><br>
이름 : <input type="text" name="admname"> <br><br>
<h4> 보안을 위해 설치 완료 후 /install 디렉터리는 삭제 바랍니다. </h4> <br><br>
<input type="submit" value="확인">

</form>

</center>

</body>
</html>