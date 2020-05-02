
<?php include "../src/database/db-connection.php"?>

<?php


class getResult
{

  function __construct()
  {
  }

  
  function callDBLink()
  {

    if(isset($_POST['FirstSelector']) && isset($_POST['SecondSelector']) && isset($_POST['ThirdSelector']))
    {}
    else{
    
      echo "<script>alert('Please Select All Values For Searching ... ');</script>"; 
       // header("Location: http://localhost:81/php%20....%2015/qccs370p2-master/public/index.php", true, 301);
        echo "<script>setTimeout(\"location.href = 'http://localhost:81/php%20....%2015/qccs370p2-master/public/index.php';\",400);</script>";
      
        return;
    }

  $hotel = $_POST['FirstSelector'];
  $type = $_POST['SecondSelector'];
  $price = $_POST['ThirdSelector'];

 $count = 0 ;
    $DBLink = new DBLink();

    echo '<table>
    <tr>
    <th>Room Number</th>
    <th>Room Type</th>
    <th>Room Price</th>
    <th>Hotel</th>
  </tr>';

    foreach ($_POST['SecondSelector'] as $t) { 
        # code...
        foreach ($_POST['ThirdSelector'] as $p) { 
           foreach ($_POST['FirstSelector'] as $h) { 
            $detail = $DBLink->getroom($p,$t,$h);
            if(!empty($detail))
                    foreach($detail as $row)
                    {
                      $count = 1;
                        echo '<tr>
                        <td>'.$row["room_num"].'</td>
                        <td>'.$row["class"].'</td>
                        <td>'.$row["price"].'</td>
                        <td>'.$row["company"].'</td>
                    </tr>';

                    }
        }
     }
    }

    echo '</table>';

if($count == 0 )
      echo '<br><br>No Data Found...';
    
  }
}

$classb = new getResult();
   $classb->callDBLink();
?>


