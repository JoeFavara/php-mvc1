<?php

class StatsModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/songs.php for more)
     */
    public function getAmountOfSongs()
    {
        $sql = "SELECT COUNT(id) AS amount_of_songs FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetch()->amount_of_songs;
    }

    /**
     * $sql = "Select id, artist, track, link from song Where artist = :song_artist";
     * Gets the total number of songs by artist
     * @param $artist_id
     */
    public function getAmountOfSongsByArtist($song_artist)
    {
        $sql = "SELECT COUNT(id) AS amount_of_songs FROM song Where artist = :song_artist";
        $query = $this->db->prepare($sql);
        $query->execute(array(':song_artist' => $song_artist));
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetch()->amount_of_songs;
    }
}
