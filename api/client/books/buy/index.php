<?php
require './APIBuyBook.php';
$api = new APIBuyBook();

if (isset($_POST['token']) && isset($_POST['is_pdf']) && isset($_POST['book_id'])) {
    $data = [
        'user_id' => $api->getClientIDByToken($_POST['token']),
        'is_pdf' => $_POST['is_pdf'],
        'book_id' => $_POST['book_id'],
    ];

    if (!empty($data['user_id'])) {
        if ($data['is_pdf'] == '1') {
            if (!$api->isAlreadyPDFOrdered($data)) {
                if ($api->buyPDFBook($data)) {
                    $api->printJSON(['code' => '200', 'message' => 'Request successfully']);
                } else 
                    $api->error("Error when inserting data");
            } else
                $api->error("PDF already ordered");
        } else {
            if ($api->buyPhysicBook($data)) {
                $api->printJSON(['code' => '200', 'message' => 'Request successfully']);
            } else
                $api->error("Error when inserting data");
        }
      
    } else 
        $api->error("Invalid user");
} else 
    $api->error("Error when calling API");