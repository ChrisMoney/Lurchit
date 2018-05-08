<?php

$files = glob('/home/pblhrakl19bs/public_html/api/flicks/*'); // get all file names
foreach($files as $file){ // iterate files
    if (is_file($file)) {
        if ($now - filemtime($file) >= 60 * 60 * 24 * 2) { // 2 days
            unlink($file);
        }
    }// delete file
}