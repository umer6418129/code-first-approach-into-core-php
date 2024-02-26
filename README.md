# Code-First Approach into Core PHP

## Description
This repository contains examples and best practices for using a code-first approach in Core PHP. It is intended for developers who are looking to understand and implement this methodology in their PHP projects.

## Table of Contents
1. [Installation](#installation)
2. [Usage](#usage)
3. [Contributing](#contributing)

## Installation
To install and run this project, you need to have PHP and MySQL installed on your machine.

1. Clone this repository.
2. Navigate to the project directory.
3. Update the `config.php` file with your database credentials.

The `config.php` file should look like this:
```php
<?php

$config = [
    "host" => "localhost",
    "username" => "root",
    "password" => "",
    "database" => "php_code_first_approach_db",
];
```

## Usage
To connect to the database, you need to call the `connectToDatabase` function from the `connection.php` file. Here's how the `connection.php` file looks:
```php
<?php
function connectToDatabase($config)
{
    $conn = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database'])or die("lost");
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    return $conn;
}
```

To create a table in the database, you can use the `createTable` function from the `BaseMigration` class in the `migration` folder. Here's how the `BaseMigration` class looks:

```php
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
```

The `BaseMigration` class is extended by other classes to create specific tables. For example, the `RoleMigration` class creates a `tbl_userRoles` table if it doesn't exist. Here's how the `RoleMigration` class looks:

```php
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
        }else{
            echo "tbl_userRoles already exist";
        }
    }
}
```


After setting up the database connection and defining your migration classes, you need to execute the migrations to create the tables in your database. This is done in the `Migrate.php` file. Here's how the `Migrate.php` file looks:

```php
<?php
require_once '../config/config.php';
require_once '../config/connection.php';
require_once 'BaseMigration.php';
require_once 'RoleMigration.php';
require_once 'UserMigration.php';

$conn = connectToDatabase($config);

$roleMigration = RoleMigration::up($conn);
$userMigration = UserMigration::up($conn);
?>
```
Alternatively, if you have a local server environment set up (like XAMPP, WAMP, or MAMP), you can also navigate to the `Migrate.php` file through your web browser by typing the local server URL followed by the path to the `Migrate.php` file. For example:

```php
http://localhost/your_project_directory/database/migrations/Migrate.php
```

if your table will not be exist that will be created

## Contributing
Currently, this project only supports creating tables. I am working on developing a full-fledged migration system for Core PHP. If you have any ideas or improvements, feel free to make a pull request.

