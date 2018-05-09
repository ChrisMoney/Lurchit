<?php

$files = glob('/home/pblhrakl19bs/public_html/api/flicks/*'); // get all file names
foreach($files as $file){
    $lastModifiedTime = filemtime($file);
    $currentTime = time();
    $timeDiff = abs($currentTime - $lastModifiedTime)/(60*60); //in hours
    if(is_file($file) && $timeDiff > 48) //check if file is modified before 48 hours
        unlink($file); //delete file
}