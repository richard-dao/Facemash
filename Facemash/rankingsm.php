<?php

	$asc_query = "SELECT * FROM images ORDER BY score DESC";
	$result = executeQuery($asc_query);


function executeQuery($query){
	$connect = mysqli_connect("localhost", "user", "password","database");
	$result = mysqli_query($connect, $query);
	return $result;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Rankings</title>
		<style>
		    body{
		        text-align:center;
		    }
			table,tr,th,td{
			border: 1px solid black;
			text-align: center;
			}
			td{
			    text-align: center;
			}
		</style>
		</head>
		<body>
		    <h1>Rankings</h1>
		    <br>
		    <div id="center_button"><button onclick="location.href='index.php'">Back to Home</button></div>
		    <br>
		    <script type = "text/javascript">
		        var rank = 1;
		    </script>
		<form action = "rankingsm.php" method = "post">
			<br>
			<table align = "center">
                <tr>
                    <th>Rank</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Wins</th>
                    <th>Losses</th>
                </tr>
                <!-- populate table from mysql database -->
                <?php 
                        $rank = 0;
                    ?>
                <?php while ($row = mysqli_fetch_array($result)): $rank++; $row[1] = str_replace("_", " ", $row[1]); ?>
                <tr>
                    
                    <td><?php echo $row[5];?></td>
                    <td><?php echo "<a href = 'profilem.php?profile=$row[0]' style = 'text-decoration: none; color: black;'><img src='m_images/".$row['filename']."' style  = 'width:75%; height: 75%;'></a>";?></td>
                    <td><a href = 'profilem.php?profile=<?=$row[0]?>' style = 'text-decoration: none; color: black;'><?= str_replace(".png", "", $row[1]);?></a></td>
                    <td><?php echo $row[2];?></td>
                    <td><?php echo $row[3];?></td>
                    <td><?php echo $row[4];?></td>
                </tr>
                
                
                <?php endwhile;?>
            </table>
        </form>
     
    </body>
</html>

			