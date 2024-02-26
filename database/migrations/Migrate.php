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
