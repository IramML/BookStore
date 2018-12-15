<?php // download.php

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $file = '/xampp/htdocs/bookstore/PDF/'.$id.'.pdf';

    if (file_exists($file)) {
        // send headers that indicate file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        // send file (must read comments): http://php.net/manual/en/function.readfile.php
        readfile($file);
        exit;
    }
}

?>