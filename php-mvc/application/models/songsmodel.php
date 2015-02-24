<?php

class SongsModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all songs from database
     */
    public function getAllSongs()
    {
        $sql = "SELECT id, artist, track, link FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Add a song to database
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     */
    public function addSong($artist, $track, $link)
    {
        // clean the input from javascript code for example
        $artist = strip_tags($artist);
        $track = strip_tags($track);
        $link = strip_tags($link);

        $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':artist' => $artist, ':track' => $track, ':link' => $link));
    }

    /**
     * Check for duplicate record same - artist, track and link trying to be added.
     * @param $artist
     * @param $track
     * @param $link
     *
     * Return true if record exists
     * Return false if record does not exist
     * @return bool
     */
    public function checkDuplicate($artist, $track, $link)
    {
        try {

            // clean the input from javascript code for example
            $artist = strip_tags($artist);
            $track = strip_tags($track);
            $link = strip_tags($link);

            $sql = "Select 1 from song Where artist = :artist and track = :track and link = :link";
            $query = $this->db->prepare($sql);
            $query->execute(array(':artist' => $artist, ':track' => $track, ':link' => $link));
            $row = $query->fetch();
            if ($row){
                return true;
            } else {
                return false;
            }


        } catch (PDOException $e) {
            echo $e->getMessage();
            echo '<br>';
            echo 'Oh My we got an error <br>';
        }

    }


    /**
     * Delete a song in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $song_id Id of song
     */
    public function deleteSong($song_id)
    {
        $sql = "DELETE FROM song WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':song_id' => $song_id));
    }

    /**
     * @param $song_artist
     * @return
     * @internal param $Artist Returns an array of songs by artist* Returns an array of songs by artist
     * @internal param $DBH
     */
    public function getSongsByArtist($song_artist)
    {

        try {

     //       echo 'Now reading the database with Fetch_Obj. Here it is <br>';
            $sql = "Select id, artist, track, link from song Where artist = :song_artist";
            $query = $this->db->prepare($sql);
            $query->execute(array(':song_artist' => $song_artist));
            return $query->fetchAll();

        } catch (PDOException $e) {
            echo $e->getMessage();
            echo '<br>';
            echo 'Oh My we got an error <br>';
        }

    }
}
