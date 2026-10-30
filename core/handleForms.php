<?php 

session_start();
require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['registerBtn'])) {
	$query = registerUser($pdo, $_POST['username'], $_POST['password'], 
		$_POST['$first_name'], $_POST['last_name'], $_POST['birth_date'], $_POST['gender']);
	if ($query) {
		header("Location: ../login.php");
	}
}

if (isset($_POST['loginBtn'])) {
    $query = loginUser($pdo, $_POST['username'], $_POST['password'], 
		$_POST['$first_name'], $_POST['last_name'], $_POST['birth_date'], $_POST['gender']);
    if ($query) {
        $_SESSION['user_id'] = $user_id;
        header("Location: ../index.php");
    } else {
        echo "Invalid credentials";
    }
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['insertAlbumBtn'])) {
	$query = insertAlbum($pdo, $_POST['album_name'], $_POST['artist_name'], 
		$_POST['producer_name'], $_POST['status'], $_POST['release_date']);

	if ($query) {
		header("Location: ../index.php");
		exit;
	}
	else {
		echo "Insertion failed";
	}

}


if (isset($_POST['editAlbumBtn'])) {
	$query = updateAlbum($pdo, $_POST['album_name'], $_POST['artist_name'], 
		$_POST['producer_name'], $_POST['status'], $_POST['release_date'], 
        $_GET['album_id']);

	if ($query) {
		header("Location: ../index.php");
		exit;
	}

	else {
		echo "Edit failed";
	}

}




if (isset($_POST['deleteAlbumBtn'])) {
	$query = deleteAlbum($pdo, $_GET['album_id']);

	if ($query) {
		header("Location: ../index.php");
		exit;
	}

	else {
		echo "Deletion failed";
	}
}




if (isset($_POST['insertNewTrackBtn'])) {
	$query = insertTrack($pdo, $_POST['track_name'], 
            $_POST['genre'], $_POST['duration_seconds'] ,
            $_POST['bpm'], $_POST['key_signature'], 
            $_POST['time_signature'], $_GET['album_id']);

	if ($query) {
		header("Location: ../viewTracks.php?album_id=" .$_GET['album_id']);
	}
	else {
		echo "Insertion failed";
	}
}




if (isset($_POST['editTrackBtn'])) {
	$query = updateTrack($pdo, $_POST['track_name'], $_POST['genre'], 
            $_POST['duration_seconds'], $_POST['bpm'], $_POST['key_signature'], 
            $_POST['time_signature'], $_GET['track_id']);

	if ($query) {
		header("Location: ../viewTracks.php?album_id=" .$_GET['album_id']);
	}
	else {
		echo "Update failed";
	}

}




if (isset($_POST['deleteTrackBtn'])) {
	$query = deleteTrack($pdo, $_GET['track_id']);

	if ($query) {
		header("Location: ../viewTracks.php?album_id=" .$_GET['album_id']);
		exit;
	}
	else {
		echo "Deletion failed";
	}
}




?>