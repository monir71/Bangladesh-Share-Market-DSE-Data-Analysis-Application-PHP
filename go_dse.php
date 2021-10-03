<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<?php
		$data = array('date1' => '2019-12-02', 'ViewCloseP' => 'View Close Price' );
		$post_data = http_build_query($data);
		$options = array('http' => array('method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $post_data));
		$context = stream_context_create($opts);
		echo file_get_contents('https://www.dsebd.org/dse_close_price.php', false, $context);
	?>
	<!--
	<form name="form1" id="form1" action="https://www.dsebd.org/dse_close_price.php" method="post">
		<input type="date" name="date1" id="date1" required>
		<input type="submit" value="View Close Price" name="ViewCloseP">
	</form>
	-->
</body>
</html>