CREATE TABLE album (
    album_id INT AUTO_INCREMENT PRIMARY KEY,
    album_name VARCHAR(50) NOT NULL,
    artist_name VARCHAR(100) NOT NULL,
    producer_name VARCHAR(100) NOT NULL,
    status VARCHAR(50) DEFAULT 'Recording',
    release_date DATE,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE track (
    track_id INT AUTO_INCREMENT PRIMARY KEY,
    album_id INT NOT NULL,
    track_name VARCHAR(100) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    duration_seconds INT,
    bpm INT,
    key_signature VARCHAR(10),
    time_signature VARCHAR(10),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    FOREIGN KEY (album_id) REFERENCES album(album_id) ON DELETE CASCADE
);

