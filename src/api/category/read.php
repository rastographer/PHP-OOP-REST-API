<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/Category.php';

// Instantiate DB & Connection
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

// Category query
$result = $category->read();

// Get row count
$num = $result->rowCount();

// Check if it has any Categories
if ($num > 0) {
    // initialize Category array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $cat_item = array(
            'id' => $id,
            'name' => $name
        );

        // Push to Data array
        array_push($cat_arr['data'], $cat_item);
    }

    // Turn to JSON & output
    echo json_encode($cat_arr);
} else {
    // No Categories
    echo json_encode(
        array('message' => 'no categories found')
    );
}