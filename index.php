<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Welcome To Music Recording Studio System</h1>
    <p>Insert the following table: </p>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="album_name">Album Name</label> 
			<input type="text" name="album_name">
		</p>
		<p>
			<label for="artist_name">Artist Name</label> 
			<input type="text" name="artist_name">
		</p>
		<p>
			<label for="producer_name">Producer Name</label> 
			<input type="text" name="producer_name">
		</p>
		<p>
			<label for="status">Status</label> 
			<input type="text" name="status">
		</p>
        <p>
			<label for="release_date">Release</label> 
			<input type="date" name="release_date">
            <input type="submit" name="insertAlbumBtn">
		</p>
	</form>
	<?php $getAllAlbum = getAllAlbum($pdo); ?>
	<?php foreach ($getAllAlbum as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 300px; margin-top: 20px;">
		<h3>Album Name: <?php echo $row['album_name']; ?></h3>
		<h3>Artist Name: <?php echo $row['artist_name']; ?></h3>
		<h3>Producer Name: <?php echo $row['producer_name']; ?></h3>
		<h3>Status: <?php echo $row['status']; ?></h3>
		<h3>Release Date: <?php echo $row['release_date']; ?></h3>
		<h3>Date Added: <?php echo $row['date_added']; ?></h3>


		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewTracks.php?album_id=<?php echo $row['album_id']; ?>">View Tracks</a>
			<a href="editAlbum.php?album_id=<?php echo $row['album_id']; ?>">Edit</a>
			<a href="deleteAlbum.php?album_id=<?php echo $row['album_id']; ?>">Delete</a>
		</div>

	</div> 
	<?php } ?>
</body>
</html>