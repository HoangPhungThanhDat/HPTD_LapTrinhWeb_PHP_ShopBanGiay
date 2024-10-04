<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once '../application/helper.php';
require_once '../application/Database.php';
require_once '../application/Route.php';
Route::route_admin();