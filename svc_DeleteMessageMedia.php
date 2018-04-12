<?php


$dir = "/home/pblhrakl19bs/public_html/api/messages"; /** define the directory **/
$now   = time();

// check if file type is a photo
$videoFileTypes = array("mpeg", "mpg", "ogg", "mp4","webm");
// video file types
$photoFileTypes = array("jpg", "jpeg", "png", "tiff","gif", "raw");

foreach (glob($dir."*") as $file) {
    $type = end(explode(".", $file));
    if (is_file($file) && (in_array($type, $videoFileType) || in_array($type, $photoFileTypes))) {
        if ($now - filemtime($file) >= 60 * 60 * 24 * 2) { // 2 days
            unlink($file);
        }
    }
}