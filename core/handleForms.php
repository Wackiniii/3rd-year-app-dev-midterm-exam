<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

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