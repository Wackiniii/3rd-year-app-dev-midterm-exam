<?php require_once 'core/handleForms.php'; ?>
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
	<?php $getAlbumByID = getAlbumByID($pdo, $_GET['album_id']); ?>
	<h1>Edit the Album:</h1>
	<form action="core/handleForms.php?album_id=<?php echo $_GET['album_id']; ?>" method="POST">
		<p>
			<label for="album_name">Album Name</label> 
			<input type="text" name="album_name" value="<?php echo $getAlbumByID['album_name']; ?>">
		</p>
		<p>
			<label for="artist_name">Artist Name</label> 
			<input type="text" name="artist_name" value="<?php echo $getAlbumByID['artist_name']; ?>">
		</p>
		<p>
			<label for="producer_name">Producer Name</label> 
			<input type="text" name="producer_name" value="<?php echo $getAlbumByID['producer_name']; ?>">
		</p>
        <p>
			<label for="status">Status</label> 
			<input type="text" name="status" value="<?php echo $getAlbumByID['status']; ?>">
		</p>
        <p>
			<label for="release_date">Release Date</label> 
			<input type="date" name="release_date" value="<?php echo $getAlbumByID['release_date']; ?>">
            <input type="submit" name="editAlbumBtn">
		</p>
	</form>
</body>
</html>