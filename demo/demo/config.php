<?php
//echo $_SERVER['RDS_HOSTNAME'];
//echo $_SERVER['RDS_USERNAME'];
//echo $_SERVER['RDS_PASSWORD'];
//echo $_SERVER['RDS_DB_NAME'];
//echo $_SERVER['RDS_PORT'];
$servername="canteen.clp43e00lqcc.us-east-1.rds.amazonaws.com";
$username="root";
$password="DBPassword";
$dbname="ebdb";
$conn = new mysqli($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
//$conn= new mysqli($servername,$username,$password,$dbname);
date_default_timezone_set('Asia/Kolkata');
?>