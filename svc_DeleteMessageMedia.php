<?php


$dir = "messages/"; /** define the directory **/
$now   = time();

// check if file type is a photo
$videoFileTypes = array("video/mpeg", "video/mpg", "video/ogg", "video/mp4",
    "video/quicktime", "video/webm", "video/x-matroska",
    "video/x-ms-wmw");
// video file types
$photoFileTypes = array("image/jpg", "image/jpeg", "image/png", "image/tiff",
    "image/gif", "image/raw");

foreach (glob($dir."*") as $file) {
    $type = end(explode(".", $file));
    if (is_file($file) && (in_array($type, $videoFileType) || in_array($type, $photoFileTypes))) {
        if ($now - filemtime($file) >= 60 * 60 * 24 * 2) { // 2 days
            unlink($file);
        }
    }
}