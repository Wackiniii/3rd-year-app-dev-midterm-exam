<?php  

function registerUser($pdo , $username, $password, $first_name, $last_name, $birth_date, $gender) {
	$hashed_password = password_hash($password, PASSWORD_ARGON2ID);

	$sql = "INSERT INTO users (username, password, first_name, last_name, birth_date, gender) 
            VALUES (?, ?, ?, ?, ?, ?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $hashed_password, $first_name, 
		$last_name, $birth_date, $gender]);

	if ($executeQuery) {
		return true;
	}
}

function loginUser($pdo , $username, $password, $first_name, $last_name, $birth_date, $gender) {
	$sql = "SELECT * FROM users WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username]);

	if ($stmt->rowCount() > 0) {
		$user = $stmt->fetch();
		if (password_verify($password, $user['password'])) {
            return $user['user_id'];
        }
	}
	return false;
}

function insertAlbum($pdo, $album_name, $artist_name, $producer_name, 
	$status, $release_date, $added_by) {

    if (trim($status) === '') {
        $status = 'Recording';
    }
    if (trim($release_date) === '') {
        $release_date = null;
    }

	$sql = "INSERT INTO album(album_name, artist_name, producer_name, 
		status, release_date, added_by) VALUES(?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$album_name, $artist_name, $producer_name, 
		$status, $release_date, $added_by]);

	if ($executeQuery) {
		return true;
	}
}



function updateAlbum($pdo, $album_name, $artist_name, $producer_name, 
	$status, $release_date, $last_modified_by, $album_id) {

	if (trim($status) === '') {
        $status = 'Recording';
    }
    if (trim($release_date) === '') {
        $release_date = null;
    }

	$sql = "UPDATE album
				SET album_name = ?,
					artist_name = ?,
					producer_name = ?, 
					status = ?,
                    release_date = ?,
					last_modified_by = ?
				WHERE album_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$album_name, $artist_name, 
            $producer_name, $status, $release_date, $last_modified_by, $album_id]);
	
	if ($executeQuery) {
		return true;
	}

}


function deleteAlbum($pdo, $album_id) {
	$deleteAlbum = "DELETE FROM album WHERE album_id = ?";
	$deleteStmt = $pdo->prepare($deleteAlbum);
	$executeDeleteQuery = $deleteStmt->execute([$album_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM album WHERE album_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$album_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}

function insertTrack($pdo, $track_name, $genre, $duration_seconds, 
                    $bpm, $key_signature, $time_signature, $added_by, $album_id) {

    if (trim($duration_seconds) === '') {
        $duration_seconds = null;
    }
    if (trim($bpm) === '') {
        $bpm = null;
    }
	if (trim($key_signature) === '') {
        $key_signature = null;
    }
	if (trim($time_signature) === '') {
		$time_signature = null;
	}
	
	$sql = "INSERT INTO track (track_name, genre, duration_seconds, 
                    bpm, key_signature, time_signature, added_by, album_id) VALUES (?,?,?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$track_name, $genre, $duration_seconds, 
                                $bpm, $key_signature, $time_signature, $added_by, $album_id]);
	if ($executeQuery) {
		return true;
	}

}

function updateTrack($pdo, $track_name, $genre, $duration_seconds, 
                    $bpm, $key_signature, $time_signature, $last_modified_by, $track_id) {
	$sql = "UPDATE track
			SET track_name = ?,
				genre = ?,
                duration_seconds = ?,
                bpm = ?,
                key_signature = ?,
                time_signature = ?,
				last_modified_by = ?
			WHERE track_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$track_name, $genre, $duration_seconds, 
                            $bpm, $key_signature, $time_signature, $last_modified_by, $track_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteTrack($pdo, $track_id) {
	$sql = "DELETE FROM track WHERE track_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$track_id]);
	if ($executeQuery) {
		return true;
	}
}


function getAllAlbum($pdo) {
	$sql = "SELECT * FROM album";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getAlbumByID($pdo, $album_id) {
	$sql = "SELECT * FROM album WHERE album_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$album_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getTracksByAlbum($pdo, $album_id) {
	
	$sql = "SELECT 
				track.track_id AS track_id,
				track.track_name AS track_name,
				track.genre AS genre,
				track.duration_seconds AS duration_seconds,
				track.bpm AS bpm,
                track.key_signature AS key_signature,
                track.time_signature AS time_signature,                
				album.artist_name AS artist_name,
                album.producer_name AS producer_name,
				track.date_added AS date_added
			FROM track
			JOIN album ON track.album_id = album.album_id
			WHERE track.album_id = ? 
			GROUP BY track.track_name;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$album_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getTrackByID($pdo, $track_id) {
	$sql = "SELECT 
				track.track_id AS track_id,
				track.track_name AS track_name,
				track.genre AS genre,
				track.duration_seconds AS duration_seconds,
                track.bpm AS bpm,
                track.key_signature AS key_signature,
                track.time_signature AS time_signature,
                track.date_added AS date_added,
				album.artist_name AS artist_name,
                album.producer_name AS producer_name
			FROM track
			JOIN album ON track.album_id = album.album_id
			WHERE track.track_id  = ? 
			GROUP BY track.track_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$track_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

?>