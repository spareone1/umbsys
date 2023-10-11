<?php
include_once ("lib/dbconfig.php");

//전체 우산 카운트
$sql_all = "SELECT * FROM umbrella;";
$res = mysqli_query ($db, $sql_all);
$all = mysqli_num_rows($res);


//대여 중이 아닌 우산 카운트
$sql_all = "SELECT * FROM umbrella WHERE um_state=0;";
$rs = mysqli_query ($db, $sql_all);
$can = mysqli_num_rows($rs);
?>

<!DOCTYPE HTML>
<html>
<head>
<title> 우산관리시스템 </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link rel ="stylesheet" href="/css/main.css">
<script type="text/javascript" src="/js/weather.js"></script>
<body>

<div class="counter" align="center">
	현재 방문자 <br>
	<script id="_waub8a">
	var _wau = _wau || []; _wau.push(["dynamic", "yqyebzqs39", "b8a", "c4302bffffff", "small"]);
	</script>
	<script async src="//waust.at/d.js"></script> <br><br>
	남은 우산 개수 <br>
	<?php echo $can; ?>개 / <?php echo $all; ?>개
</div>

<div class="weather" align="center">
	<script>getLocation();</script>
</div>

</body>
</html>