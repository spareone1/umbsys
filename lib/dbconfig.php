<?php


define('HOST', 'localhost');
define('USER', 'umbsys');
define('PW', 'dik3513!');
define('DBNAME', 'umbsys');
$db = mysqli_connect(HOST, USER, PW, DBNAME) or die ('데이터베이스 서버에 연결할 수 없습니다.');

mysqli_select_db($db, DBNAME) or die ('데이터베이스 연결에 실패했습니다.');


/*
$host = "localhost";
$user = "umbsys";
$pw = "dik3513!";
$dbname = "umbsys";

if($this->dbconnection == null) {
	$this->dbconnection = new mysqli($host, $user, $pw, $dbname);
	$this->dbconnection->set_charset("utf8");
}
*/
?>