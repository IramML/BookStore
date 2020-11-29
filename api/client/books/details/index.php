<?php
require './APIBookDetails.php';
$api = new APIBookDetails();

if (isset($_GET['token']) && isset($_GET['book_id'])) {
    $data = [
        'user_id' => $api->getClientIDByToken($_GET['token']),
        'book_id' => $_GET['book_id']
    ];

    if (!empty($data['user_id'])) {
        $book = $api->getBookByID($data['book_id']);

        if (!empty($book)) {
            $api->printJSON(['code' => '200', 'message' => 'Request successfully', 'book' => $book]);
        } else 
            $api->error("Error when obtaining book");
    } else 
        $api->error("Invalid user");
} else 
    $api->error("Error when calling API");