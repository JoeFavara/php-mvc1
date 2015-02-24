<?php

/**
 * Class Songs
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Songs extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function index()
    {
        // simple message to show where you are
        echo 'Message from Controller: You are in the Controller: Songs, using the method index().';


        // load a model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $songs_model = $this->loadModel('SongsModel');
        // load another model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $stats_model = $this->loadModel('StatsModel');

        // Check if artist is set in session. Load by artist providing no errors
        if (isset($_SESSION["artist"]) and (!isset($_SESSION["error"])) ){
            $songs = $songs_model->getSongsByArtist($_SESSION["artist"]);
            $amount_of_songs = $stats_model->getAmountOfSongsByArtist($_SESSION["artist"]);
        } else {
            $songs = $songs_model->getAllSongs();
            $amount_of_songs = $stats_model->getAmountOfSongs();
        }


       // Check if any errors  and display them

        if (isset($_SESSION["error"])){
            $error = $_SESSION["error"];
        }

        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/songs/index.php';
        require 'application/views/_templates/footer.php';


        // clean up session variables

        if (isset($_SESSION["error"])){
            $error = null;
            $_SESSION["error"] = null;
        }

        if (isset($_SESSION["artist"])){
            $_SESSION["artist"] = null;
        }

        if (isset($_SESSION["track"])){
            $_SESSION["track"] = null;
        }

        if (isset($_SESSION["link"])){
            $_SESSION["link"] = null;
        }

    }

    /**
     * ACTION: addSong
     * This method handles what happens when you move to http://yourproject/songs/addsong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a song" form on songs/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     * $num_rows =  $songs_model->checkDuplicate($_POST["artist"], $_POST["track"], $_POST["link"]);
     *
     */
    public function addSong()
    {
        // simple message to show where you are
      //  echo 'Message from Controller: You are in the Controller: Songs, using the method addSong().';

        // if we have POST data to create a new song entry
        if (isset($_POST["submit_add_song"])) {

            // load model, perform an action on the model
            // check if record exists. If it does not add it, otherwise display error.

            $songs_model = $this->loadModel('SongsModel');
            if ($songs_model->checkDuplicate($_POST["artist"], $_POST["track"], $_POST["link"])) {

                $_SESSION["error"] = "Record already exists in table";
                $_SESSION["artist"] = $_POST["artist"];
                $_SESSION["track"]  = $_POST["track"];
                $_SESSION["link"]   = $_POST["link"];

            } else {

                // check for blank fields.
                // No blanks $verified is true run add song
                // Blanks set error

                $vars = array('artist', 'track','link');
                $verified = TRUE;
                foreach($vars as $v) {
                    if(strlen(trim($_POST[$v])) == 0) {
                        $verified = FALSE;
                    }
                }

                if ($verified){
                    $songs_model->addSong($_POST["artist"], $_POST["track"], $_POST["link"]);
                } else{
                    $_SESSION["error"] = "Fields must not be blank when adding a record";
                }

            }

        }

        // where to go after song has been added
        header('location: ' . URL . 'songs/index');
    }

    /**
     * ACTION: deleteSong
     * This method handles what happens when you move to http://yourproject/songs/deletesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a song" button on songs/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $song_id Id of the to-delete song
     */
    public function deleteSong($song_id)
    {
        // simple message to show where you are
       // echo 'Message from Controller: You are in the Controller: Songs, using the method deleteSong().';

        // if we have an id of a song that should be deleted
        if (isset($song_id)) {
            // load model, perform an action on the model
            $songs_model = $this->loadModel('SongsModel');
            $songs_model->deleteSong($song_id);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'songs/index');
    }

    /**
     * @param $artist_id
     */
    public function getSongsByArtist($artist_id)
    {
        // simple message to show where you are
      //  echo 'Message from Controller: You are in the Controller: Songs, using the method getSongsByArtist().';

        // if we have an id of a song that should be deleted
        if (isset($artist_id)) {
            // load model, perform an action on the model
            $songs_model = $this->loadModel('SongsModel');
            $songs = $songs_model->getSongsByArtist($artist_id);
        }

        // where to go after to display songs by artist
        header('location: ' . URL . 'songs/index');
    }

    /**
     * @param $artist_id
     * Sets the session variable artist to be used for selecting songs by artist
     */
    public function setSessionArtist($artist_id)
    {
        if (isset($artist_id)) {
            $_SESSION["artist"] = $artist_id;
        }

        // where to go after to display songs by artist
        header('location: ' . URL . 'songs/index');
    }


}
