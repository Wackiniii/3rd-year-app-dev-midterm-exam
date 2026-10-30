<?php 

session_start();
require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['registerBtn'])) {
	$query = registerUser($pdo, $_POST['username'], $_POST['password'], 
		$_POST['first_name'], $_POST['last_name'], $_POST['birth_date'], $_POST['gender']);
	if ($query) {
		header("Location: ../login.php");
		exit;
	}
	else {
		$_SESSION['message'] = "Please fill up the input fields";
		header("Location: ../login.php");
	exit;
}
} 

if (isset($_POST['loginBtn'])) {
    $query = loginUser($pdo, $_POST['username'], $_POST['password']);
    if ($query) {
        $_SESSION['user_id'] = $query;
        header("Location: ../index.php");
		exit;
    } else {
		$_SESSION['message'] = "Invalid credentials";
		header("Location: ../login.php");
		exit;
	}
} 

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['insertAlbumBtn'])) {
	$added_by = $_SESSION['user_id'];
	$query = insertAlbum($pdo, $_POST['album_name'], $_POST['artist_name'], 
		$_POST['producer_name'], $_POST['status'], $_POST['release_date'], $added_by);

	if ($query) {
		header("Location: ../index.php");
		exit;
	}
	else {
		echo "Insertion failed";
	}

}

if (isset($_POST['editAlbumBtn'])) {
	$last_modified_by = $_SESSION['user_id'];
	$query = updateAlbum($pdo, $_POST['album_name'], $_POST['artist_name'], 
		$_POST['producer_name'], $_POST['status'], $_POST['release_date'], 
		$last_modified_by, $_GET['album_id']);

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
	$added_by = $_SESSION['user_id'];
	$query = insertTrack($pdo, $_POST['track_name'], 
            $_POST['genre'], $_POST['duration_seconds'] ,
            $_POST['bpm'], $_POST['key_signature'], 
            $_POST['time_signature'], $added_by, $_GET['album_id']);

	if ($query) {
		header("Location: ../viewTracks.php?album_id=" .$_GET['album_id']);
		exit;
	}
	else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editTrackBtn'])) {
	$last_modified_by = $_SESSION['user_id'];
	$query = updateTrack($pdo, $_POST['track_name'], $_POST['genre'], 
            $_POST['duration_seconds'], $_POST['bpm'], $_POST['key_signature'], 
            $_POST['time_signature'], $last_modified_by, $_GET['track_id']);

	if ($query) {
		header("Location: ../viewTracks.php?album_id=" .$_GET['album_id']);
		exit;
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