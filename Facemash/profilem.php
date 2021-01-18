<?php
include('mysqlm.php');
include('functions.php');


if($_GET['profile']){
    
    
    $id = $_GET['profile'];
    $query = "SELECT * FROM battles WHERE winner= $id OR loser = $id ORDER BY battle_id DESC LIMIT 10";
    $result = @mysqli_query($connection, $query);
    $recentMatches = array();
    while($row = mysqli_fetch_object($result)){
        $recentMatches[] = (object) $row;
    }
    
    $queryProfile = "SELECT * FROM images WHERE image_id = $id";
    $result2 = @mysqli_query($connection, $queryProfile);
    $profile = mysqli_fetch_object($result2);
    $profileFileName = $profile->filename;
    $temp = str_replace("_", " ", $profile->filename);
    $profileName = str_replace(".png", "", $temp);
    
    
    echo "<div style = 'margin: 0; padding: 0; border-top: 1px solid black; border-bottom: 1px solid black; background-color: white;'>
    <h1>FaceMash</h1>
    <ul>
        <a href='index.php' style='color: black;'><li>Home</li></a>
        <li>
        <div class='dropdown'>
            <a href='boys.php' style='color: #002892;'> Male Edition <i class='fa fa-caret-down' style='color: #002892; display: inline;'></i></a>
            <div class='dropdownLinks'>
                <a href='boys.php' style='color: #002892;'>Male Vote</a>
            <a href='rankingsm.php' style='color: #002892;'>Male Rankings</a>
            </div>
        </div>
        </li>
        <li>
        <div class='dropdown'>
            <a href='girls.php' style='color: #DC4548;'> Female Edition <i class='fa fa-caret-down' style='color: #DC4548;'></i></a>
            <div class='dropdownLinks'>
                <a href='girls.php' style='color: #DC4548;'>Female Vote</a>
            <a href='rankings.php' style='color: #DC4548;'>Female Rankings</a>
            </div>
        </div>
        </li>
        <a href='ourgoal.php' style='color: black;'><li>Our Goal</li></a>
        <a href='faq.php' style='color: black;'><li>FAQ</li></a>
        <a href='contactus.php' style='color: black;'><li>Contact Us</li></a>
    </ul>
</div>
";
    echo "<div style = 'margin-left: 25%; padding: 0; background-color: white; width: 15%; display: block; float: left; margin-top: 1%;'>";
    echo "<h2 style='color: black; display: block; width: 90%; height: auto; padding-top: 10%; padding: 5%;'>$profileName</h2>";
    echo "<img src='m_images/$profileFileName' style='position: relative; width: 50%; height: auto;'>";
    echo"<br><br>";
    echo "<h4 style='color: black; background-color: white;'>Stats:</h4>";
    echo "<h4 style='width: auto; height: auto;'>Rank: ", $profile->rank, "</h4>";
    echo "<h4>Score: ", $profile->score, "</h4>";
    echo "<h4>Wins: ", $profile->wins, "</h4>";
    echo "<h4>Losses: ", $profile->losses, "</h4>";
    
    
    
    
    
    echo "</div>";
    echo "<br>";
    echo "<center style='display: inline-block; width: 25%; float: right; margin-right: 25%; margin-top: -0.5%; background-color: white;'>";
    
}
?>


<html>
<head>
    <title><?= $profileName; ?></title>
    
    <style>
        body{
            text-align: center;
            padding-inline-start: 0;
        }
        img{
            display:block;
            margin-left: auto;
            margin-right: auto;
            width: auto;
            height: 20%;
            padding: 0;
        }
        p{
            display: block;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            color: black;
        }
        td{
            padding: 0;
            width: 30%;
            height: auto;
        }
        body, html {font-family:Arial, Helvetica, sans-serif;width:100%;margin:0;padding:0;text-align:center; background-color: #002892}
h1 {background-color: #DC4548;color:white;padding:20px 0;margin:0; border-bottom: 1px solid black;}
h2{color:white;}
h3{color: white;}
h4 {background-color: #DC4548;color:white;padding:20px 0; padding-left: 30px; padding-right: 30px; margin:0; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 1.5em;}
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
            <?php
    echo"<h2 style='color: black;'>Recent Matches</h2>";
    echo "<table style='margin: 0; padding: 0; width: 60%;'>";
    for($i = 0; $i < count($recentMatches); $i++){
        $winnerid = $recentMatches[$i]->winner;
        $loserid = $recentMatches[$i]->loser;
        $queryWinner = "SELECT * FROM images WHERE image_id = $winnerid";
        $result3 = @mysqli_query($connection, $queryWinner);
        mysqli_data_seek($result3, 0);
        $winner = mysqli_fetch_object($result3);
        $winnerFile = $winner->filename;
        $queryLoser = "SELECT * FROM images WHERE image_id = $loserid";
        $result4 = @mysqli_query($connection, $queryLoser);
        $loser = mysqli_fetch_object($result4);
        $loserFile = $loser->filename;
        $tempWin = str_replace("_", " ", $winnerFile);
        $tempLose = str_replace("_", " ", $loserFile);
        $winnerName = str_replace(".png", "", $tempWin);
        $loserName = str_replace(".png", "", $tempLose);
        
        if($winnerid == $id){
            echo "<tr><td valign='top'><img src= m_images/$winnerFile></td><td valign='top'><p style='margin-top: 25%; color: green;'>Won Against</p></td><td valign='top'><img src = m_images/$loserFile></td></tr>";
        echo "<tr><td valign='top'><p>$winnerName</p></td>";
        echo "<td></td>";
        echo "<td valign='top'><p>$loserName</p></td></tr>";
        }
        else{
            echo "<tr><td valign='top'><img src= m_images/$loserFile></td><td valign='top'><p style='margin-top: 25%; color: red;'>Lost Against</p></td><td valign='top'><img src = m_images/$winnerFile></td></tr>";
        echo "<tr><td valign='top'><p>$loserName</p></td>";
        echo "<td></td>";
        echo "<td valign='top'><p>$winnerName</p></td></tr>";
        }
        
    }
    echo "</table></center>";
            ?>
        
    
    
    </body>




</html>