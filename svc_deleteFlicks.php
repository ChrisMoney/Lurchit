<?php

$dir = "/home/pblhrakl19bs/public_html/api/flicks/"; /** define the directory **/
$now   = time();

foreach (glob($dir."*") as $file) {
    //$type = end(explode(".", $file));
    if (is_file($file)) {
        if ($now - filemtime($file) >= 60 * 60 * 24 * 2) { // 2 days
            unlink($file);
        }
    }
}