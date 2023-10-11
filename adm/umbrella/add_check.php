<?php

include_once ("../../lib/dbconfig.php");


$rfid = $_GET['rfid'];
$umbname = $_GET['umbname'];
$umbsort = $_GET['umbsort'];

//공백 확인
if($rfid == "" || $umbname == "" || $umbsort == "" ){
	echo "
	<script>
	alert('공백 없이 입력하세요.');
	history.back();
	</script>
	";
	die;
}

//RFID중복 체크
$sql = "SELECT COUNT(*) FROM umbrella WHERE rfid_id='$rfid' ";
$res = mysqli_query($db, $sql);
$rs = mysqli_fetch_row($res);
$already_registered_count = $rs[0];


if ($already_registered_count > 0) {
	echo "
	<script>
	alert('이미 등록된 RFID 값 입니다. 다른 아이디를 입력하세요.');
	history.back();
	</script>
	";
	die;
}

//이름 중복 체크
$sql = "SELECT COUNT(*) FROM umbrella WHERE um_name='$umbname' ";
$res = mysqli_query($db, $sql);
$rs = mysqli_fetch_row($res);
$already_registered_count = $rs[0];


if ($already_registered_count > 0) {
	echo "
	<script>
	alert('이미 등록된 이름입니다. 다른 아이디를 입력하세요.');
	history.back();
	</script>
	";
	die;
}


$umbsql = "INSERT INTO umbrella (
	rfid_id,um_name,um_type,um_state
	) values (
	'$rfid','$umbname','$umbsort',0
	)
	";


mysqli_query($db, $umbsql);          //회원 계정 생성 쿼리 실행

$sql = "SELECT COUNT(*) FROM umbrella WHERE rfid_id='$rfid' ";
$res = mysqli_query($db, $sql);
$rs = mysqli_fetch_row($res);
$already_registered_count = $rs[0];


if ($already_registered_count > 0) {
	echo "<script>
		alert ('우산이 등록되었습니다.');
		location.replace('./list.php');
	</script> ";
} else {
	echo "<script>
		alert ('우산 등록에 실패하였습니다.');
		history.back();
	</script> ";
}

?>