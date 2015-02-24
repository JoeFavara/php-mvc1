CHANGE LOG
==========

**January 4th 2014**
- fixed htaccess issue when there's a controller named "index" and a base index.php (which collide)

**December 29th 2013**
- fixed case-sensitive model file loading (thanks "grrnikos")


Enhancements January 2015
==========
1. Added URL to select songs by artist in songs/index.php
2. Error messages displayed in songs/index.php
3. Prevent blank rows from being added in songs/addsong.php (In next release will have Java Script check for blanks)
4. In model songsmodel.php added the following functions: getSongsByArtist - gets songs by artist, checkDuplicate - checks for duplicate rows
5. In model statsmodel.php added the following functions: getAmountOfSongsByArtist - summarizes artist's songs.
6. In controller songs.php added the following functions: setSessionArtist - sets ID to artist, getSongsByArtist - calls songsmodel/getSongsByArtist.
7. Confirm delete.




