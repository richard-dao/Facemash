<?php


include('mysqlm.php');
include('functions.php');

@session_unset();
@session_destroy();
@session_start();

// Get random
$query="SELECT * FROM images ORDER BY RAND() LIMIT 0,1";
$result = @mysqli_query($connection, $query);
$images = array();
$images[0]= mysqli_fetch_object($result);
$_SESSION['left'] = $images[0]->image_id; 
$diff = 50;
$score1 = $images[0]->score;
$low = $score1-$diff;
$high = $score1+$diff;
$query2 = "SELECT * FROM images WHERE score BETWEEN $low AND $high";
$result2 = @mysqli_query($connection, $query2);
$potentialMatchups = array();



while(count($potentialMatchups) <= 1){ //While $potentialMatchups has no matches (expect itself which is why <= 1 instead of 0)
    $potentialMatchups = array(); //Reset Array
    $diff += 50; //Increment Difference
    $low = $score1-$diff; //Update Bottom Range
    $high = $score1+$diff; //Update Top Range
    $query2 =  "SELECT * FROM images WHERE score BETWEEN $low AND $high"; //Redefine query? Don't know if this does anything but I did it anyways
    $result2 = @mysqli_query($connection, $query2); //Redefine $result2
    mysqli_data_seek($result2, 0); //Set pointer for $result2 back to 0
    while($row = mysqli_fetch_object($result2)){ //While object at pointer exists, put into $potentialMatchups
        $potentialMatchups[] = (object) $row;
    }
}

$images[1] = $potentialMatchups[rand(0, count($potentialMatchups)-1)]; //Set $images[1] to a random image from $potentialMatchups
while($images[0]->filename == $images[1]->filename){ //If choose same person as first, choose different person from $potentialMatchups
    $images[1] = $potentialMatchups[rand(0, count($potentialMatchups)-1)]; 
}
$_SESSION['right'] = $images[1]->image_id;

// Close the connection
$leftName = str_replace("_", " ", $images[0]->filename);
$rightName = str_replace("_", " ", $images[1]->filename);
$rank = 1;
$query3 = "SELECT * FROM images ORDER BY score DESC";
$result3 = @mysqli_query($connection, $query3);

while($row3 = mysqli_fetch_object($result3)){
    $image_id = $row3->image_id;
    mysqli_query($connection, "UPDATE images SET rank = $rank WHERE image_id = $image_id");
    $rank++;
}
mysqli_close($connection);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FaceMash</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">

body, html {font-family:Arial, Helvetica, sans-serif;width:100%;margin:0;padding:0;text-align:center; background-color: #DC4548}
h1 {background-color: #002892;color:white;padding:20px 0;margin:0; border-bottom: 1px solid black;}
h2{color:white;}
h3{color: white;}
h4 {background-color: #002892;color:white;padding:20px 0; padding-left: 30px; padding-right: 30px; margin:0; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 1.5em;}
a img {border:0;}
td {font-size:11px; color:white;}
.image {background-color:#eee;border:1px solid #ddd;border-bottom:1px solid #bbb;padding:5px;}
ul{text-align:center; padding-inline-start: 0;}
li{display: inline-block; padding: 1%;}
li a {text-decoration: none;}
.drowdown{
    position: relative;
    display: inline-block;
}
li:hover{
    background-color: #ddd;
}
.dropdownLinks{
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdownLinks a{
    color: black;
    padding: 10%;
    text-decoration: none;
    display: block;
    text-align: left;
}
.dropdownLinks a:hover{
    background-color: #ddd;
}
.dropdown:hover .dropdownLinks {display: block;}

</style>

</head>
<body>
<div style = "margin: 0; padding: 0; border-top: 1px solid black; border-bottom: 1px solid black; background-color: white;">
    <h1>FaceMash</h1>
    <ul>
        <a href="index.php" style="color: black;"><li>Home</li></a>
        <li>
        <div class="dropdown">
            <a href="boys.php" style="color: #002892;"> Male Edition <i class="fa fa-caret-down" style="color: #002892; display: inline;"></i></a>
            <div class="dropdownLinks">
                <a href="boys.php" style="color: #002892;">Male Vote</a>
            <a href="rankingsm.php" style="color: #002892;">Male Rankings</a>
            </div>
        </div>
        </li>
        <li>
        <div class="dropdown">
            <a href="girls.php" style="color: #DC4548;"> Female Edition <i class="fa fa-caret-down" style="color: #DC4548;"></i></a>
            <div class="dropdownLinks">
                <a href="girls.php" style="color: #DC4548;">Female Vote</a>
            <a href="rankings.php" style="color: #DC4548;">Female Rankings</a>
            </div>
        </div>
        </li>
        <a href="ourgoal.php" style="color: black;"><li>Our Goal</li></a>
        <a href="faq.php" style="color: black;"><li>FAQ</li></a>
        <a href="contactus.php" style="color: black;"><li>Contact Us</li></a>
    </ul>
</div>
    
<div style="border-left: 1px solid black;border-right: 1px solid black;">
    <br>
<center>
    <h3>"Were we let in for our looks? No. Will we be judged on them? Yes." - Mark Zuckerberg 2003</h3>
<h2>Who's hotter? Click to Choose</h2>
<table>
    
	<tr>
		<td valign="top" class="image"><a href="rateleftm.php"><img src="m_images/<?=$images[0]->filename?>" /></a></td>
        
		<td valign="top" class="image"><a href="raterightm.php"><img src="m_images/<?=$images[1]->filename?>" /></a></td>
	</tr>
    <tr>
        <td>Rank: <?= $images[0]->rank?></td>
        <td>Rank: <?= $images[1]->rank?></td>
    </tr>
	<tr>
        
        <td>Name: <?= str_replace(".png", "", $leftName);?></td>
        <td>Name: <?= str_replace(".png", "", $rightName);?></td>
        
        
    </tr>
	<tr>
		<td>Won: <?=$images[0]->wins?>, Lost: <?=$images[0]->losses?>, Total: <?=$images[0]->wins + $images[0]->losses?></td>
		<td>Won: <?=$images[1]->wins?>, Lost: <?=$images[1]->losses?>, Total: <?=$images[1]->wins + $images[1]->losses?></td>
	</tr>
	<tr>
		<td>Score: <?=$images[0]->score?></td>
		<td>Score: <?=$images[1]->score?></td>
	</tr>
	<tr>
		<td>Expected Percent Of Winning: <?=round(expected($images[1]->score, $images[0]->score) * 100, 2)?>%</td>
		<td>Expected Percent Of Winning: <?=round(expected($images[0]->score, $images[1]->score) * 100, 2)?>%</td>
	</tr>
</table>
    <h2><button style = "font-family:Arial, Helvetica, sans-serif;font-size: 30px; padding: 1%; text-align:center;" onclick="location.reload()">Skip</button></h2>
</center>
<h4>Taking too long to load images? Click on the Current Rankings below and preload all images! Then come back and choose away! </h4>
<br>
<button style = "font-family:Arial, Helvetica, sans-serif;font-size: 40px; padding: 2%; text-align:center;" onclick="location.href='rankingsm.php'">Current Rankings</button>
<br>
<br>
<br>
    </div>

</body>
</html>
