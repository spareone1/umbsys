<?php

$um_name = $_GET['um_name'];
$rfid = $_GET['rfid'];
$um_state = $_GET['um_state'];

session_start();

//주소창에 입력해서 들어온 경우 접근 제한
if ($um_name == "") {
	echo "<script>
	alert ('잘못된 접근입니다.');
	history.back();
	</script>
	";
	die;
}

if($_SESSION['level'] < 8) {
	echo "<script>
		alert ('잘못된 접근입니다.');
		history.back();
		</script>";
	die;
}

echo "<script>
	alert('".$um_name." 우산을 삭제합니다.');
	</script>
	";
	

//대여 상태거나 연체 상태의 우산은 삭제 불가
if ($um_state > 0) {
	echo "<script>
	alert ('대여 상태거나 연체 상태의 우산은 삭제가 불가능합니다.');
	history.back();
	</script>
	";
	die;
}

include_once ("../../lib/dbconfig.php");

$sql = "DELETE FROM umbrella WHERE rfid_id='$rfid'";
mysqli_query($db, $sql);

//삭제되었는지 확인
$sql = "SELECT COUNT(*) FROM umbrella WHERE rfid_id='$rfid' ";
$res = mysqli_query($db, $sql);
$rs = mysqli_fetch_row($res);
$already_registered_count = $rs[0];


if ($already_registered_count == 0) {
	echo "
	<script>
	alert('삭제되었습니다.');
	history.back();
	</script>
	";
	die;
} else {
	echo "
	<script>
	alert('삭제를 실패했습니다.');
	history.back();
	</script>
	";
	die;
}
?>