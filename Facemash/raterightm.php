<?php


include('mysqlm.php');
include('functions.php');


// If rating - update the database
session_start();

// If rating - update the database


$_SESSION['winner'] = $_SESSION['right'];
$_SESSION['loser'] = $_SESSION['left'];
	// SESSION the winner
	$result = mysqli_query($connection,"SELECT * FROM images WHERE image_id = ".$_SESSION['winner']." ");
	$winner = mysqli_fetch_object($result);


	// SESSION the loser
	$result = mysqli_query($connection,"SELECT * FROM images WHERE image_id = ".$_SESSION['loser']." ");
	$loser = mysqli_fetch_object($result);


	// Update the winner score
	$winner_expected = expected($loser->score, $winner->score);
	$winner_new_score = win($winner->score, $winner_expected);
		//test print "Winner: ".$winner->score." - ".$winner_new_score." - ".$winner_expected."<br>";
	mysqli_query($connection,"UPDATE images SET score = ".$winner_new_score.", wins = wins+1 WHERE image_id = ".$_SESSION['winner']);


	// Update the loser score
	$loser_expected = expected($winner->score, $loser->score);
	$loser_new_score = loss($loser->score, $loser_expected);
		//test print "Loser: ".$loser->score." - ".$loser_new_score." - ".$loser_expected."<br>";
	mysqli_query($connection,"UPDATE images SET score = ".$loser_new_score.", losses = losses+1  WHERE image_id = ".$_SESSION['loser']);


	// Insert battle
	mysqli_query($connection,"INSERT INTO battles SET winner = ".$_SESSION['winner'].", loser = ".$_SESSION['loser']." ");


	// Back to the frontpage
    session_unset();
    session_destroy();


	// Back to the frontpage
	header('Refresh: 0; url=boys.php');
	
}


?>