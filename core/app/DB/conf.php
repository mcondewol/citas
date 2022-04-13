<?php 


// define('DB_HOSTNAME','localhost'); // database host name
// define('DB_USERNAME', 'zambos_pic'); // database user name
// define('DB_PASSWORD', 'z@mb0s2020!'); // database password
// define('DB_NAME', 'zambospic'); // database name 


define('DB_HOSTNAME','aprofam-db.cedzwrni6pi1.us-west-2.rds.amazonaws.com'); // database host name
define('DB_USERNAME', 'admin'); // database user name
define('DB_PASSWORD', 'apr0f4m21'); // database password
define('DB_NAME', 'bookmedik'); // database name 

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 
$db = 'mysql:host='.DB_HOSTNAME.';dbname='.DB_NAME;
$dbhost = new PDO($db, DB_USERNAME, DB_PASSWORD, $options);

?>