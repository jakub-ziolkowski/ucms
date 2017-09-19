<?php

include 'FormUtils.php';

class Utils {

    public static function randomString($length = 5) {
        return substr(str_shuffle(str_repeat($x = 'abcdef0123456789', ceil($length / strlen($x)))), 1, $length);
    }

    public function extractZip($filePath, $outputDirectory) {
        $zip = new ZipArchive;
        $zip->open($filePath);
        $zip->extractTo($outputDirectory);
        $zip->close();
    }

}
