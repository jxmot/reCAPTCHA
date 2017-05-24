<?php
// caller/visitor id 
// will record the date/time and ip, also checks the
// size of the file and if it exceeds a fixed value
// then it is copied and renamed with the current 
// date and then the original file is deleted.
$callerid = SITE_ID . '_callerid.log';
$idpath   = './';
$idfile   = $idpath . $callerid;
if(file_exists($idfile)) {
    // limit the size of a log file
    if(filesize($idfile) > 20000) {
        // make a time stamped copy and delete the 
        // current file.
        $oldfile = $idpath . date('Ymd-His-') . $callerid;
        copy($idfile, $oldfile);
        unlink($idfile);
    }
}
$record = date('Y/m/d - H:i:s') . ' > ' . $_SERVER['REMOTE_ADDR'] . "\r\n";
$fileid = fopen($idfile,'a');
fwrite($fileid, $record);
fclose($fileid);
?>
