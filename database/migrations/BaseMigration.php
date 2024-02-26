<?php

class BaseMigration {
    public static function createTable($conn, $sql) {
        if ($conn->query($sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
}
?>