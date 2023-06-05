<?php
class Category {

     // DB stuff
     private $conn;
     private $table = 'categories';

     // Properties
     public $id;
     public $name;
     public $created_at;

     // Instantiate constructor
     public function __construct($db) {
        $this->conn = $db;
    }

    // Create Category
    public function create(){
        // Create Query
        $query = 'INSERT INTO ' . $this->table . '
        SET
            name = :name';

        // Prepare Query
        $stmt = $this->conn->prepare($query);

        // Clean Data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // Bind Data
        $stmt->bindParam(':name', $this->name);

        // Execute Query
        if($stmt->execute()) {
            return true;
        } else {
            // Print Err if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

    }

    // Read All Categories
    public function read(){
        // Create Query
        $query = 'SELECT
            id,
            name,
            created_at
        FROM ' . $this->table . '
        ORDER BY
            created_at DESC';
        
        // Prepare Query
        $stmt = $this->conn->prepare($query);

        // Execute Query
        $stmt->execute();

        return $stmt;
        
    }

    // Read One Category
    public function read_single(){
        // Create Query
        $query = 'SELECT 
            c.id,
            c.name,
            c.created_at
        FROM ' . $this->table . ' c 
        WHERE
            c.id = ?
        LIMIT 0,1';

        // Prepare Query
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->name = $row['name'];
        
    }

    // Update Category
    public function update(){
        // Create Query
        $query = 'UPDATE ' . $this->table . '
            SET
                name = :name
            WHERE
                id = :id';

        // Prepare Query
        $stmt = $this->conn->prepare($query);

        // Clean Data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // Bind Data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);

        // Execute Query
        if($stmt->execute()) {
            return true;
        } else {
            // Print Err if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    // Delete Category
    public function delete(){
        // Create Query
        $query = 'DELETE FROM ' . $this->table . '
            WHERE id = :id';

        // Prepare Query
        $stmt = $this->conn->prepare($query);

        // Bind Data
        $stmt->bindParam(':id', $this->id);

        // Execute Query
        if($stmt->execute()) {
            return true;
        } else {
            // Print Err if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
        
    }



}