<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../Config/Database.php';
include_once '../../Models/Category.php';

// Instantiate DB & Connection
$database = new Database();
$db = $database->connect();

// Instantiate Category object
$category = new Category($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$category->id = $data->id;

// DELETE Category
if($category->delete()) {
    echo json_encode(
        array('message' => 'Category deleted')
    );
} else {
    echo json_encode(
        array('message' => 'CategoryNot deleted')
    );
}