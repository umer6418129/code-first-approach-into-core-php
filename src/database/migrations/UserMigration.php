<?php

class UserMigration extends BaseMigration
{
    public static function up($conn)
    {
        try {
            $sql = "SHOW TABLES LIKE 'tbl_user'";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                $sql = "CREATE TABLE tbl_user (
                    id BIGINT AUTO_INCREMENT PRIMARY KEY,
                    f_name VARCHAR(30) NOT NULL,
                    l_name VARCHAR(30) NOT NULL,
                    email_phone VARCHAR(50) NOT NULL,
                    gender ENUM('Male', 'Female','Other') NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    isapprove TINYINT(1) DEFAULT 0,
                    isactive TINYINT(1) DEFAULT 0,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    role_id INT,
                    FOREIGN KEY (role_id) REFERENCES tbl_userroles(id)
                )";
                self::createTable($conn, $sql);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public static function down($conn)
    {
        try {
            $sql = "SHOW TABLES LIKE 'tbl_user'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $sql = "DROP TABLE tbl_user";
                self::createTable($conn, $sql);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

}

