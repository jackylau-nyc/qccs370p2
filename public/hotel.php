<?php include __DIR__."/components/session.php";?>	
<!DOCTYPE html>
<html>
	<head>
		<title> Hotel </title> 
		<?php include __DIR__."/components/header.php";?>
		<link rel="stylesheet" href="./css/hotelroom.css">
	</head>
	<body>
<<<<<<< Updated upstream
		<?php include __DIR__."/components/navbar.php"?>
		<?php include __DIR__."/components/hotelroom.php"?>
		<?php include __DIR__."/components/default-scripts.php";?>
	</body>
</html>
=======
		<?php include __DIR__."/components/navbar.html"?>
		<?php // Does not exist yet include __DIR__."/components/hotelroom.html"?>
			<?php include __DIR__."/calendar/load.php"?>
				<script>
		$("#currentDate").change(function(){
  // var $x = $("calendar");
  // $x.prop("color", "FF0000");
  // $x.append("The color property: " + $x.prop("color"));
  // $x.removeProp("color");
  var dee = $("#currentDate").val()
  console.log(dee);
  var tomorrow = new Date();
tomorrow.setDate(dee + 1);
  $('#calendar').fullCalendar('gotoDate',new Date('2020-05-05'));
});
</script>
	</body>

</html>
>>>>>>> Stashed changes
