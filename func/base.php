<?php

function scan() {
    $files = array();
    foreach (glob("csv/*.csv") as $file) {
        $files[] = $file;
    }
    return $files;
}

