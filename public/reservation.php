<?php include __DIR__."/components/session.php";?>	
<!DOCTYPE html>
<html>
	<head>
		<title> Reservation </title>
		<?php include __DIR__."/components/header.php";?>
		<link href="./css/customerstyle.css" rel="stylesheet" />
	</head>
	<body>
		<?php include __DIR__."/components/navbar.php"?>
		<?php include __DIR__."/components/customer.html"?>
		<?php include __DIR__."/components/default-scripts.php";?>
	</body>
		<script type="text/javascript">
  		// Get this to work when it's in nav.js
  		window.onload = () => {
  			keepMin();
  			reserveMin();
  		}
	</script>

</html>