<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/Category.php';

// Instantiate DB & Connection
$database = new Database();
$db = $database->connect();

// Instantiate Category object
$category = new Category($db);

// Get ID from URL
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get Post
$category->read_single();

// Create array
$cat_arr = array(
    'id' => $category->id,
    'name' => $category->name
);

// Make JSON
print_r(json_encode($cat_arr));