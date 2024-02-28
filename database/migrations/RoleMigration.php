<?php

class RoleMigration extends BaseMigration
{
    public static function up($conn)
    {
        $sql = "SHOW TABLES LIKE 'tbl_userRoles'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            $sql = "CREATE TABLE tbl_userRoles (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
            self::createTable($conn, $sql);
            echo "tbl_userRoles has created";
        }
    }

    public static function down($conn)
    {
        try {
            $sql = "SHOW TABLES LIKE 'tbl_userRoles'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $sql = "DROP TABLE tbl_userRoles";
                self::createTable($conn, $sql);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
