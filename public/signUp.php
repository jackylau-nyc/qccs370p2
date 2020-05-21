<?php include __DIR__."/components/session.php"?>	
<!DOCTYPE html>
<html>
	<head>
		<title>Signup</title>
		<?php include __DIR__."/components/header.php";?>
		<link rel="stylesheet" href="./css/createAccountStyle.css">
	</head>
	<body>
		<?php include __DIR__."/components/navbar.php"?>
		<?php include __DIR__."/components/createAccount.html"?>
		<?php include __DIR__."/components/default-scripts.php";?>
		<script type="text/javascript" src="../scripts/js/signup.js"></script>
	</body>
		<script type="text/javascript">
  		// Get this to work when it's in nav.js
  		window.onload = () => {
  			keepMin();
  			reserveMin();
  		}
	</script>

</html>