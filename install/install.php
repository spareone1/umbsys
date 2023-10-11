<?php

$host = $_POST['host'];
$user = $_POST['user'];
$pw = $_POST['pw'];
$dbname = $_POST['dbname'];

$connect = mysqli_connect($host, $user, $pw, $dbname);

mysqli_select_db($connect, $dbname) or die('DB 선택 실패');


//user 테이블 생성
//user 테이블이 존재할 경우 삭제
$userdelsql = "DROP TABLE IF EXISTS user;";
	
//user 테이블이 존재하지 않을 경우 생성
$usersql =	"CREATE TABLE IF NOT EXISTS user (
	rowid INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	userid CHAR(20) default NULL,
	pw CHAR(100) default NULL,
	name CHAR(50) default NULL,
	level INT(11) default '0',
	grade CHAR(5) default NULL,
	classes CHAR(5) default NULL,
	num CHAR(5) default NULL,
	state INT(5) default '0',
	cannot_lend VARCHAR(30) default NULL
	);";
	


//umbrella 테이블 생성
//umbrella 테이블이 존재할 경우 삭제
$umdelsql = "DROP TABLE IF EXISTS umbrella;";

//umbrella 테이블이 존재하지 않을 경우 생성
$umsql = "CREATE TABLE IF NOT EXISTS umbrella (
	rowid INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	rfid_id VARCHAR(50) default NULL,
	um_name CHAR(50) default NULL,
	um_type CHAR(20) default NULL,
	um_state INT(5) default '0',
	um_userid CHAR(50) default NULL,
	um_dastate INT(5) default NULL
	);";



//lend 테이블 생성
//lend 테이블이 존재할 경우 삭제
$lnddelsql = "DROP TABLE IF EXISTS lend;";

//lend 테이블이 존재하지 않을 경우 생성
$lndsql = "CREATE TABLE IF NOT EXISTS lend (
	rowid INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	num INT(11) default '1',
	userid CHAR(20) default NULL,
	state INT(5) default '0',
	user_umname CHAR(50) default NULL,
	input_date VARCHAR(30) default NULL,
	lend_date VARCHAR(30) default NULL
	);";

//tmpumb (임시 RFID 값 저장용) 테이블 생성
//tmpumb 테이블이 존재할 경우 삭제
$tmpumbdelsql = "DROP TABLE IF EXISTS tmpumb;";

//lend 테이블이 존재하지 않을 경우 생성
$tmpumbsql = "CREATE TABLE IF NOT EXISTS tmpumb (
	rfid VARCHAR(20) default NULL
	);";

	
//board 테이블 생성
//board 테이블이 존재할 경우 삭제
$bbsdelsql = "DROP TABLE IF EXISTS board;";	

//board 테이블이 존재하지 않을 경우 생성
$bbssql = "CREATE TABLE IF NOT EXISTS board (
	rowid INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	num INT(11) default '1',
	name VARCHAR(30) default NULL,
	userid VARCHAR(30) default NULL,
	subject VARCHAR(100) default NULL,
	content TEXT default NULL,
	input_date VARCHAR(30) default NULL,
	input_time VARCHAR(30) default NULL,
	access VARCHAR(30) default NULL
	);";

	
	
//dbconfig.php 파일 생성
$file = "{$_SERVER['DOCUMENT_ROOT']}/lib/dbconfig.php";
$f = @fopen($file, 'a') or die ("not open file data one"); 

fwrite($f, "<?php\n\n");
fwrite($f, "define('HOST', '{$host}');\n");
fwrite($f, "define('USER', '{$user}');\n");
fwrite($f, "define('PW', '{$pw}');\n");
fwrite($f, "define('DBNAME', '{$dbname}');\n");
fwrite($f, "\$db = mysqli_connect(HOST, USER, PW, DBNAME) or die ('데이터베이스 서버에 연결할 수 없습니다.');\n\n");
fwrite($f, "mysqli_select_db(\$db, DBNAME) or die ('데이터베이스 연결에 실패했습니다.');\n\n");
fwrite($f, "?>");

fclose($f);
@chmod($file, 644);


//최고관리자 계정을 생성합니다
$admid = $_POST['admid'];
$admname = $_POST['admname'];
$admpw = $_POST['admpw'];

if($admid == "" || $admname == "" || admpw == ""){
	echo "
	<script>
	alert('최고관리자 정보가 정확하지 않습니다. 공백 없이 입력하세요.');
	history.back();
	</script>
	";
	die;
}

$admsql = "INSERT INTO user (
	userid,pw,name,level,grade,classes,num,state
	) values (
	'$admid',MD5('$admpw'),'$admname',10,0,0,0,0
	)
	";

	
//쿼리 실행
mysqli_query($connect, $userdelsql);	  //user 테이블 삭제 쿼리 실행
mysqli_query($connect, $usersql);	      //user 테이블 생성 쿼리 실행
mysqli_query($connect, $umdelsql);        //umbrella 테이블 삭제 쿼리 실행
mysqli_query($connect, $umsql);           //umbrella 테이블 생성 쿼리 실행
mysqli_query($connect, $lnddelsql);       //order 테이블 삭제 쿼리 실행
mysqli_query($connect, $lndsql);          //order 테이블 생성 쿼리 실행
mysqli_query($connect, $tmpumbdelsql);          //tmpumb 테이블 삭제 쿼리 실행
mysqli_query($connect, $tmpumbsql);          //tmpumb 테이블 생성 쿼리 실행
mysqli_query($connect, $bbsdelsql);       //board 테이블 삭제 쿼리 실행
mysqli_query($connect, $bbssql);          //board 테이블 생성 쿼리 실행
mysqli_query($connect, $admsql);          //최고관리자 계정 생성 쿼리 실행

echo "설치완료";


mysqli_close($connect);                   //mysql 접속 해제
?>