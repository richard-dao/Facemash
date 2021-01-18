<?php
	    $asc_query = "SELECT * FROM images ORDER BY score DESC";
	    $result = executeQuery2($asc_query);
        function executeQuery2($query){
	        $connect = mysqli_connect("localhost", "user", "password","database");
	        $result = mysqli_query($connect, $query);
	        return $result;
        }
        $row = mysqli_fetch_array($result);
        $name = str_replace("_", " ", $row['filename']);
        ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FaceMash</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" href="myfavicon.ico" type="image/x-icon" />
<style type="text/css">

body, html {font-family:Arial, Helvetica, sans-serif;width:100%;margin:0;padding:0;text-align:center; background-color: #eeeeee}
h1 {background-color: #002892;color:white;padding:20px 0;margin:0; border-bottom: 1px solid black;}
a img {border:0;}
td {font-size:11px;}
.image {background-color:#eee;border:1px solid #ddd;border-bottom:1px solid #bbb;padding:5px;}
ul{text-align:center; padding-inline-start: 0;}
li{display: inline-block; padding: 1%;}
li a {text-decoration: none;}
br {line-height: 0%;}
.drowdown{
    position: relative;
    display: inline-block;
}
li:hover{
    background-color: #ddd;
}
li2{
    display: inline-block;
    padding: 1%;
    background-color: white;
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
<div style = "margin: 0; padding: 0; border-top: 1px solid black; border-bottom: 1px solid black; background-color:white;">
    <h1>FaceMash</h1>
    <ul>
        <a href="index.php" style="color: black;"><li>Home</li></a>
        <li>
        <div class="dropdown">
            <a href="boys.php" style="color: #002892;">Male Edition <i class="fa fa-caret-down" style="color: #002892; display: inline;"></i></a>
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
<div style = "margin: 0; padding: 0;">
    <br>
    <ul>
    <h2 style="border-bottom: 3px solid black; text-align:center; margin-left: 30%; margin-right:30%; padding: 10px; align: center;">Current Champions</h2>
    
        <li2><?php echo "<img src='m_images/".$row['filename']."'>";?><h2 style="color: #002892">Hottest Male</h2>Name: <?php echo str_replace(".png", "", $name); ?><br>Score: <?php echo $row[2]?><br> Wins: <?php echo $row[3]?></li2>
        <?php

	        $asc_query = "SELECT * FROM images ORDER BY score DESC";
	        $result = executeQuery($asc_query);


            function executeQuery($query){
	            $connect = mysqli_connect("localhost", "user", "password","database");
	            $result = mysqli_query($connect, $query);
	            return $result;
            }
            $row = mysqli_fetch_array($result);
            $nameGirl = str_replace("_", " ", $row['filename']);
        ?>
        <li2><?php echo "<img src='images/".$row['filename']."'>";?><h2 style="color: #DC4548">Hottest Female</h2>Name: <?php echo str_replace(".png", "", $nameGirl); ?><br>Score: <?php echo $row[2]?><br> Wins: <?php echo $row[3]?></li2>
        
    </ul>    
    
    
</div>
<br>
<br>
<br>
<br>
<br>
</body>
</html>
