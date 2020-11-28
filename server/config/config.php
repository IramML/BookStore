<?php
define('IS_PRODUCTION', false);

if(constant('IS_PRODUCTION')){
    define('URL', '');
    define('URL_UPLOADS', '');
    define('HOST', '');
    define('DB', '');
    define('USER', '');
    define('PASSWORD', '');
    define('CHARSET', 'utf8');
}else{
    define('URL', 'http://192.168.0.27/book_store/server/');
    define('URL_UPLOADS', 'http://192.168.0.27/book_store/server/uploads/');
    define('HOST', 'localhost');
    define('DB', 'book_store');
    define('USER', 'root');
    define('PASSWORD', '');
    define('CHARSET', 'utf8');
}