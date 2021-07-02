<!DOCTYPE html>
<html>
<head>
	<title>Set ON OFF</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<br><br>
	<select id="selectTime">
		<option value="1">1 min</option>
		<option value="5">5 min</option>
		<option value="10">10 min</option>
		<option value="20">20 min</option>
		<option value="40">40 min</option>
		<option value="60">1 h</option>
	</select>
	<br><br>
	<input type="submit" onclick="sendState()" value="ON/OFF"></input>
	<br><br>
	<div>Estado:</div>
	<div id="estado"></div>

<script src="jquery-3.6.0.min.js"></script>
<script src="scripts/index_script.js"></script>
<div class="db_class"><a href="relatorio/index.php" target="_blank"><img src="db.png"></a></div>
</body>
</html>