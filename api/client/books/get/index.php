<?php
require './APIGetBooks.php';
$api = new APIGetBooks();

if (isset($_GET['token'])) {
    $userID = $api->getClientIDByToken($_GET['token']);

    if (!empty($userID)) {
        $books = $api->getBooks();
        if (!empty($books)) {
            $api->printJSON(['code' => '200', 'message' => 'Request successfully', 'books' => $books]);
        } else 
            $api->error("No books");
    } else 
        $api->error("Invalid user");
} else
    $api->error("Error when calling API");